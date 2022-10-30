@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">

        </div>
        <div class="card-body">
            <h5 class="card-title text-center"> Відписатися від всіх російських YouTube каналів</h5>
            <p class="card-text">
                @if(!$hasAuth)
                    Треба авторизуватись:
                    <a href="{{ route(\App\Http\Controllers\YoutubeUnsubscribeController::AUTH_ROUTE) }}" class="btn btn-outline-primary">
                        <i class="bi bi-youtube"></i> Авторизуватись
                    </a>
                @endif

                <form method="POST" action="{{ route(YoutubeUnsubscribeController::AUTH_UNSUBSCRIBE_ROUTE) }}">
                <fieldset>
                <legend>Канали:</legend>
                @forelse ($channels as $channel)
                    @if (empty($channel['title']))
                        @continue
                    @endif

                    <div>
                        <input
                            type="checkbox"
                            id="ch-{{ $channel['id'] }}"
                            name="subscriptionIds"
                            value="{{ $channel['subscriptionId']  }}"
                            {{ $channel['isUa'] ? 'disabled' : 'checked' }}
                        >
                        <label for="ch-{{ $channel['id'] }}">{{ $channel['isUa'] ? '🇺🇦' : '' }} {{ $channel['title'] }}</label>
                    </div>
                @empty
                    <p>Список підписок пустий</p>
                @endforelse
                </fieldset>
                <button type="submit">Submit</button>
                </form>
            </p>
        </div>
        <div class="card-footer text-muted text-center">
        </div>
    </div>
@endsection
