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

                @forelse ($channels as $channel)
                    {{ dump($channel) }}
                @empty
                    <p>Список підписок пустий</p>
                @endforelse
            </p>
        </div>
        <div class="card-footer text-muted text-center">
        </div>
    </div>
@endsection
