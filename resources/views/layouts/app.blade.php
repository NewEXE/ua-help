<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }} </title>

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
        .spoiler input, .spoiler div  {
            display: none;
        }
        .spoiler :checked ~ div {
            display: block;
            /*padding: 10px;*/
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="top-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <b>{{ config('app.name', 'Laravel') }}</b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a id="switchLocaleDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-translate"></i> <b>{{ Config::get('app.locales')[App::getLocale()] }}</b>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="switchLocaleDropdown">
                                @foreach (Config::get('app.locales') as $locale => $language)
                                    <a class="dropdown-item {{ $locale === App::getLocale() ? 'disabled' : '' }}" href="{{ route('locale.switch', ['locale' => $locale]) }}">
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" id="main-content-header"><h3>@yield('title')</h3></div>
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                    You can read this page in:
                                    @foreach (Config::get('app.locales') as $locale => $language)
                                        @if($locale !== App::getLocale())
                                            <a href="{{ route('locale.switch', ['locale' => $locale]) }}">{{ $language }}</a>@if(!$loop->last), @else. @endif
                                        @endif
                                    @endforeach
                                </div>
                                @yield('content')
                                @if(Route::currentRouteName() !== 'index')
                                    <p class="text-end"><a href="{{ route('index') }}">{{ __('Go to main page')  }}</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
