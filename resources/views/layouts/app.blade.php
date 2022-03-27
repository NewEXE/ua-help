<!doctype html>
<html lang="{{ \App\Http\Middleware\LocaleManager::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    {!! SEO::generate() !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Site colors */
        #top-navbar {
            background-color: #009bff !important;
        }

        #main-content-header {
            background-color: #ffcd00;
        }

        /* External links icon */
        a[target="_blank"]:after {
            content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAQElEQVR42qXKwQkAIAxDUUdxtO6/RBQkQZvSi8I/pL4BoGw/XPkh4XigPmsUgh0626AjRsgxHTkUThsG2T/sIlzdTsp52kSS1wAAAABJRU5ErkJggg==);
            margin: 0 3px 0 5px;
        }

        /* Spoiler */
        .spoiler input, .spoiler div {
            display: none;
        }

        .spoiler :checked ~ div {
            display: block;
            /*padding: 10px;*/
        }
    </style>

    <!-- Favicon -->
    <!-- Created via https://realfavicongenerator.net/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="top-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <b>{{ __(config('app.name', 'Laravel')) }}</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Locale switcher -->
                    <li class="nav-item dropdown">
                        <a id="switchLocaleDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                        >
                            <i class="bi bi-translate"></i> <b>{{ \App\Http\Middleware\LocaleManager::getLocalesList()[App::getLocale()] }}</b>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="switchLocaleDropdown">
                            @foreach (\App\Http\Middleware\LocaleManager::getLocalesList() as $locale => $language)
                                <a class="dropdown-item {{ $locale === App::getLocale() ? 'disabled' : '' }}"
                                   href="{{ route('locale.switch', ['locale' => $locale]) }}">
                                    {{ $language }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" id="main-content-header"><h3>{{ SEOMeta::getTitleSession() }}</h3></div>
                        <div class="card-body">
                            @if(empty($onlyUaVersion))
                                <div class="alert alert-primary" role="alert">
                                    You can read this page in:
                                    @foreach (\App\Http\Middleware\LocaleManager::getLocalesList(true) as $locale => $language)
                                        <a href="{{ route('locale.switch', ['locale' => $locale]) }}">{{ $language }}</a>@if(!$loop->last), @else. @endif
                                    @endforeach
                                </div>
                            @endif
                            @yield('content')
                            <br />
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <i class="bi bi-github"></i>
                                        <a href="{{ \App\Support\Helpers::getViewUrlInRepository($path) }}"
                                           target="_blank">{{ __('Improve this page') }}</a>
                                    </p>
                                </div>
                                <div class="col">
                                    @if(Route::currentRouteName() !== 'index')
                                        <p class="text-end"><i class="bi bi-house"></i> <a
                                                href="{{ route('index') }}">{{ __('Go to main page')  }}</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
