<?php

namespace App\Http\Controllers;

use App\Support\Str;
use Google\Client;
use Google\Service\YouTube;
use Google\Service\YouTube\SubscriptionListResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YoutubeUnsubscribeController extends Controller
{
    public const INDEX_PAGE_ROUTE = 'yt.index';
    public const AUTH_ROUTE = 'yt.auth';
    public const AUTH_REDIRECT_ROUTE = 'yt.auth-redirect';
    public const AUTH_UNSUBSCRIBE_ROUTE = 'yt.unsubscribe';

    private const ACCESS_TOKEN_KEY = 'yt_access_token';

    private const UA_SUBSTRINGS = ['і','ї','є','ґ','.ua','ukraine'];
    private const RU_SUBSTRINGS = ['ы','ё','ъ','.ru','russia','vk.com'];

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

        $enableUaUncheck = false;

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
                        foreach ($channels as &$channel) {
                            if ($channel['id'] === $channelObj->getId()) {
                                $this->processChannel($channel, $channelObj);
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
     * @throws ValidationException
     */
    public function unsubscribe(Request $request): RedirectResponse
    {
        $validated = Validator::make([
            'subscriptionIds' => $request->input('subscriptionIds'),
        ], [
            'subscriptionIds' => ['required', 'array', 'min:1', 'max:50'],
        ])->validate();

        $token = session(self::ACCESS_TOKEN_KEY);
        if (empty($token)) {
            return $this->deauth();
        }

        $this->client->setAccessToken($token);
        $youtube = new YouTube($this->client);

        $subscriptionIds = $validated['subscriptionIds'];

        // TODO make "async" calls via Guzzle
        foreach ($subscriptionIds as $subscriptionId) {
            try {
                $youtube->subscriptions->delete($subscriptionId);
            } catch (\Google\Service\Exception $exception) {
                if ($exception->getCode() === 401) {
                    return $this->deauth();
                }
            }
        }

        return redirect()->back(302, [], self::INDEX_PAGE_ROUTE);
    }

    /**
     * @return RedirectResponse
     */
    private function deauth(): RedirectResponse
    {
        session()->remove(self::ACCESS_TOKEN_KEY);
        return redirect()->route(self::INDEX_PAGE_ROUTE);
    }

    private function processChannel(array &$channel, YouTube\Channel $channelObj): void
    {
        static $ua = 'ua';
        static $uaLang = 'uk';

        static $ru = 'ru';
        static $ruLang = 'ru';

        $channel['isProcessed'] = true;

        $channel['isUa'] = $channel['isRu'] = $channel['isUnknown'] = false;

        $channel['title'] = $channelObj->getSnippet()->getTitle();
        $channel['country'] = $channelObj->getSnippet()->getCountry();
        $channel['lang'] = $channelObj->getSnippet()->getDefaultLanguage();
        $channel['avatarUrl'] = $channelObj->getSnippet()->getThumbnails()->getDefault()->getUrl();
        $channel['channel'] = $channelObj; // for debug

        $title = $channelObj->getSnippet()->getTitle();
        $desc = $channelObj->getSnippet()->getDescription();
        $country = Str::lower($channelObj->getSnippet()->getCountry());
        $lang = Str::lower($channelObj->getSnippet()->getDefaultLanguage());

        $channel['isUaCountry'] = $country === $ua;
        $channel['isUaLang'] = $lang === $uaLang;

        if ($channel['isUaCountry'] || $channel['isUaLang']) {
            $channel['isUa'] = true;
            return;
        }

        $channel['isUaTitle'] = Str::contains($title, self::UA_SUBSTRINGS, true);

        if ($channel['isUaTitle']) {
            $channel['isUa'] = true;
            return;
        }

        $channel['isUaDesc'] = Str::contains($desc, self::UA_SUBSTRINGS, true);

        if ($channel['isUaDesc']) {
            $channel['isUa'] = true;
            return;
        }

        $channel['isRuCountry'] = $country === $ru;
        $channel['isRuLang'] = $lang === $ruLang;

        if (!$channel['isRuCountry'] && empty($lang)) {
            $channel['isUnknown'] = true;
            return;
        }

        if (!$channel['isRuCountry'] && !$channel['isRuLang']) {
            $channel['isUnknown'] = true;
            return;
        }

        if (!empty($country) && !$channel['isRuCountry']) {
            $channel['isUnknown'] = true;
            return;
        }

        if ($channel['isRuCountry'] || $channel['isRuLang']) {
            $channel['isRu'] = true;
            return;
        }


        if (empty($country)) {
            $channel['isRuDesc'] = Str::contains($desc, self::RU_SUBSTRINGS, true);
            $channel['isRuTitle'] = Str::contains($title, self::RU_SUBSTRINGS, true);
            $channel['isRu'] = $channel['isRuDesc'] || $channel['isRuTitle'];
        }

        if (!$channel['isRu']) {
            $channel['isUnknown'] = true;
        }
    }
}
