@php use App\Http\Controllers\YoutubeUnsubscribeController; @endphp
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
                    <a href="{{ route(YoutubeUnsubscribeController::AUTH_ROUTE) }}" class="btn btn-outline-primary">
                        <i class="bi bi-youtube"></i> Авторизуватись
                    </a>
                @else
                <form method="POST" action="{{ route(YoutubeUnsubscribeController::AUTH_UNSUBSCRIBE_ROUTE) }}">
                    @csrf
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
                                    name="subscriptionIds[]"
                                    value="{{ $channel['subscriptionId']  }}"
                                    {{ $channel['isUa'] ? 'disabled' : '' }}
                                    {{ $channel['isRu'] ? 'checked' : '' }}
                                >
                                <label for="ch-{{ $channel['id'] }}">
                                    {{ $channel['isUa'] ? '🇺🇦' : '' }}{{ $channel['isRu'] ? '💩' : '' }}
                                    {{ $channel['title'] }}
                                </label>
                            </div>
                        @empty
                            <p>Список підписок пустий</p>
                        @endforelse
                    </fieldset>
                    <button type="submit">Submit</button>
                    </form>
                    @if($prevPageToken || $nextPageToken)
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ route(YoutubeUnsubscribeController::INDEX_PAGE_ROUTE) }}">На першу</a></li>
                            @if($prevPageToken)
                                <li class="page-item"><a class="page-link" href="{{ route(YoutubeUnsubscribeController::INDEX_PAGE_ROUTE, ['p' => $prevPageToken]) }}">&laquo; Назад</a></li>
                            @endif
                            @if($nextPageToken)
                                <li class="page-item"><a class="page-link" href="{{ route(YoutubeUnsubscribeController::INDEX_PAGE_ROUTE, ['p' => $nextPageToken]) }}">Вперед &raquo;</a></li>
                            @endif
                        </ul>
                    </nav>
                    @endif
                @endif
            </p>
        </div>
        <div class="card-footer text-muted text-center">
        </div>
    </div>
@endsection
