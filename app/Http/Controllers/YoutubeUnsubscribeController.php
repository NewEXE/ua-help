<?php

namespace App\Http\Controllers;

use App\Support\Str;
use Google\Client;
use Google\Service\YouTube;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class YoutubeUnsubscribeController extends Controller
{
    public const INDEX_PAGE_ROUTE = 'yt.index';
    public const AUTH_ROUTE = 'yt.auth';
    public const AUTH_REDIRECT_ROUTE = 'yt.auth-redirect';

    public const ACCESS_TOKEN_KEY = 'yt_access_token';

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
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        $token = session(self::ACCESS_TOKEN_KEY);

        $channels = [];
        $hasAuth = false;
        if (!empty($token)) {
            // Get user's subscriptions, channels and combine for unsubscribe possibility

            $this->client->setAccessToken($token);
            $youtube = new YouTube($this->client);

            try {
                $subscriptions = $youtube->subscriptions->listSubscriptions('snippet', [
                    'mine' => true,
                    'maxResults' => 500,
                ]);

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
                        'maxResults' => 500,
                    ]);
                    /** @var YouTube\Channel $channelObj */
                    foreach ($ytChannels as $channelObj) {
                        $channelId = $channelObj->getId();
                        foreach ($channels as &$channel) {
                            if ($channel['id'] === $channelId) {
                                $channel['title'] = $channelObj->getSnippet()->getTitle();
                                $channel['avatarUrl'] = $channelObj->getSnippet()->getThumbnails()->getDefault()->getUrl();
                                $channel['isUaCountry'] = Str::lower($channelObj->getSnippet()->getCountry()) === 'ua';
                                $channel['isUaLang'] = Str::lower($channelObj->getSnippet()->getDefaultLanguage()) === 'uk';
                                $channel['isUaDesc'] = Str::contains($channelObj->getSnippet()->getDescription(), ['і','ї','є','.ua','ґ'], true);
                                $channel['isUa'] = $channel['isUaCountry'] || $channel['isUaLang'] || $channel['isUaDesc'];
                            }
                        }
                        unset($channel); // prevent side-effects
                    }
                }
            } catch (\Google\Service\Exception $exception) {
                if ($exception->getCode() === 401) {
                    session()->remove(self::ACCESS_TOKEN_KEY);
                    return redirect()->refresh();
                }
            }

            $hasAuth = true;
        }

        return view('youtube.index', [
            'path' => 'youtube/index',
            'channels' => $channels,
            'hasAuth' => $hasAuth
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
}
