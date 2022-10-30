<?php

namespace App\Http\Controllers;

use App\Support\Str;
use Google\Client;
use Google\Service\YouTube;
use Google\Service\YouTube\SubscriptionListResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class YoutubeUnsubscribeController extends Controller
{
    public const INDEX_PAGE_ROUTE = 'yt.index';
    public const AUTH_ROUTE = 'yt.auth';
    public const AUTH_REDIRECT_ROUTE = 'yt.auth-redirect';
    public const AUTH_UNSUBSCRIBE_ROUTE = 'yt.unsubscribe';

    public const SETTING_ENABLE_UA_UNCHECK = 'enableUaUncheck';
    private const ACCESS_TOKEN_KEY = 'yt_access_token';

    private const UA_CHARS = ['і','ї','є','ґ','.ua'];
    private const RU_CHARS = ['ы','ё','ъ','.ru'];

    private Client $client;

    public function __construct()
    {
        $this->middleware('doNotCacheResponse');

        $this->client = new Client();
        $this->client->setAuthConfig(config_path('youtube_client_secrets.json'));
        $this->client->addScope(YouTube::YOUTUBE);
        $this->client->setRedirectUri(route(self::AUTH_REDIRECT_ROUTE));

        parent::__construct();
    }

    /**
     * YouTube unsubscribe main page.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        $token = session(self::ACCESS_TOKEN_KEY);
        $pageToken = $request->query('p');
        $nextPageToken = $prevPageToken = null;

        $enableUaUncheck = (bool) $request->query('enableUaUncheck');
        if ($enableUaUncheck) {
            session()->put(self::SETTING_ENABLE_UA_UNCHECK, true);
        } else {
            $enableUaUncheck = session(self::SETTING_ENABLE_UA_UNCHECK, false);
        }

        $channels = [];
        $hasAuth = false;
        if (!empty($token)) {
            // Get user's subscriptions, channels and combine for unsubscribe possibility

            $this->client->setAccessToken($token);
            $youtube = new YouTube($this->client);

            $getSubscriptionOptions = [
                'mine' => true,
                'maxResults' => 50,
                'order' => 'alphabetical',
            ];
            if ($pageToken) {
                $getSubscriptionOptions['pageToken'] = $pageToken;
            }
            try {
                /** @var SubscriptionListResponse $subscriptions */
                $subscriptions = $youtube->subscriptions->listSubscriptions('snippet', $getSubscriptionOptions);
                $nextPageToken = $subscriptions->getNextPageToken();
                $prevPageToken = $subscriptions->getPrevPageToken();

                /** @var YouTube\Subscription $subscription */
                foreach ($subscriptions as $subscription) {
                    $channels[] = [
                        'id' => $subscription->getSnippet()->getResourceId()->getChannelId(),
                        'subscriptionId' => $subscription->getId(),
                    ];
                }

                if (!empty($channels)) {
                    $ytChannels = $youtube->channels->listChannels('snippet', [
                        'id' => array_column($channels, 'id'),
                        'maxResults' => 50,
                    ]);
                    /** @var YouTube\Channel $channelObj */
                    foreach ($ytChannels as $channelObj) {
                        $channelId = $channelObj->getId();
                        foreach ($channels as $k => &$channel) {
                            if ($channel['id'] === $channelId) {
                                $channel['title'] = $channelObj->getSnippet()->getTitle();
                                $channel['avatarUrl'] = $channelObj->getSnippet()->getThumbnails()->getDefault()->getUrl();
                                $channel['obj'] = $channelObj; // for debug

                                $channel['isUaCountry'] = Str::lower($channelObj->getSnippet()->getCountry()) === 'ua';
                                $channel['isUaLang'] = Str::lower($channelObj->getSnippet()->getDefaultLanguage()) === 'uk';
                                $channel['isUaDesc'] = Str::contains($channelObj->getSnippet()->getDescription(), self::UA_CHARS, true);
                                $channel['isUaTitle'] = Str::contains($channelObj->getSnippet()->getTitle(), self::UA_CHARS, true);
                                $channel['isUa'] = $channel['isUaCountry'] || $channel['isUaLang'] || $channel['isUaDesc'] || $channel['isUaTitle'];

                                $channel['isRuCountry'] = Str::lower($channelObj->getSnippet()->getCountry()) === 'ru';
                                $channel['isRuLang'] = Str::lower($channelObj->getSnippet()->getDefaultLanguage()) === 'ru';
                                $channel['isRuDesc'] = Str::contains($channelObj->getSnippet()->getDescription(), self::RU_CHARS, true);
                                $channel['isRuTitle'] = Str::contains($channelObj->getSnippet()->getTitle(), self::RU_CHARS, true);
                                $channel['isRu'] = ($channel['isRuCountry'] || $channel['isRuLang']) || (!$channel['isUa'] && ($channel['isRuDesc'] || $channel['isRuTitle']));
                            }
                        }
                        unset($channel); // prevent side-effects
                    }
                }
            } catch (\Google\Service\Exception $exception) {
                if ($exception->getCode() === 401) {
                    return $this->deauth();
                }
            }

            $hasAuth = true;
        }

        //dump($channels);

        return view('youtube.index', [
            'path' => 'youtube/index',
            'channels' => $channels,
            'hasAuth' => $hasAuth,
            'enableUaUncheck' => $enableUaUncheck,
            'nextPageToken' => $nextPageToken,
            'prevPageToken' => $prevPageToken,
        ]);
    }

    /**
     * Redirect to YouTube auth page.
     *
     * @return RedirectResponse
     */
    public function auth(): RedirectResponse
    {
        return redirect()->route(self::AUTH_REDIRECT_ROUTE);
    }

    /**
     * YouTube auth redirect handle.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authRedirect(Request $request): RedirectResponse
    {
        $code = $request->input('code');

        if (empty($code)) {
            $authUrl = $this->client->createAuthUrl();
            return redirect()->away($authUrl);
        }

        $this->client->fetchAccessTokenWithAuthCode($code);
        session()->put(self::ACCESS_TOKEN_KEY, $this->client->getAccessToken());
        return redirect()->route(self::INDEX_PAGE_ROUTE);
    }

    /**
     * Unsubscribe from YouTube channels.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function unsubscribe(Request $request): RedirectResponse
    {
        $subscriptionIds = $request->input('subscriptionIds');

        if (empty($subscriptionIds) || !is_array($subscriptionIds)) {
            return redirect()->route(self::INDEX_PAGE_ROUTE);
        }

        $token = session(self::ACCESS_TOKEN_KEY);
        if (empty($token)) {
            return $this->deauth();
        }

        $this->client->setAccessToken($token);
        $youtube = new YouTube($this->client);

        foreach ($subscriptionIds as $subscriptionId) {
            try {
                $youtube->subscriptions->delete($subscriptionId);
            } catch (\Google\Service\Exception $exception) {
                if ($exception->getCode() === 401) {
                    return $this->deauth();
                }
            }
        }

        return redirect()->route(self::INDEX_PAGE_ROUTE);
    }

    /**
     * @return RedirectResponse
     */
    private function deauth(): RedirectResponse
    {
        session()->remove(self::ACCESS_TOKEN_KEY);
        return redirect()->route(self::INDEX_PAGE_ROUTE);
    }
}
