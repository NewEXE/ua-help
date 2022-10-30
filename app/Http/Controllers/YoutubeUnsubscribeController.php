<?php

namespace App\Http\Controllers;

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
     * @return View
     */
    public function index(): View
    {
        $channels = [];
        $hasAuth = false;

        $token = session(self::ACCESS_TOKEN_KEY);
        if (!empty($token)) {
            $this->client->setAccessToken($token);
            $youtube = new YouTube($this->client);
            $channels = $youtube->channels->listChannels('snippet', ['mine' => true]);
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
        session(self::ACCESS_TOKEN_KEY, $this->client->getAccessToken());
        return redirect()->route(self::INDEX_PAGE_ROUTE);
    }
}
