@extends('layouts.app')

@section('content')
    <div class="card">
        <div
            class="card-header text-center"
            {{-- show debug data on dblclick --}}
            ondblclick="document.getElementById('debug-data').classList.remove('visually-hidden')"
        >
            Крок 2/3. Обрати девайс
        </div>

        <div class="card-body">
            <h5 class="card-title text-center">Визначити пристрій</h5>
            <p class="card-text">
                Для того, щоб зробити атаку найбільш ефективною, потрібно підібрати найбільш підходящий інструмент,
                сумісний з твоїм пристроєм (ноутбуком, комп'ютером, планшетом чи смартфоном).
                Зараз ми знайдемо сумісну програму. Чи правильно ми визначили твій девайс?
            </p>

        {{-- Ambigous device (OS X or iOS) --}}
        @if(in_array($device['name'], [\App\Support\ClientInfo\Detector::OSX, \App\Support\ClientInfo\Detector::IOS], true))
                <h5>Твій девайс - це пристрій на {!! $device['icon'] !!} <b>{{ $device['name'] }}</b>.</h5>
            <p class="card-text">
                    Це може бути:
                <ul>
                    @if($device['name'] === \App\Support\ClientInfo\Detector::OSX)
                        <li>
                            <i class="bi bi-laptop"></i> <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::OSX]) }}">ноутбук (MacBook)</a>
                        </li>
                        <li>
                            <i class="bi bi-pc-display"></i> <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::OSX]) }}">комп'ютер (Mac, Mac mini, iMac)</a>
                        </li>
                    @endif
                    <li>
                        <i class="bi bi-phone"></i> <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::IPHONE]) }}">смартфон (iPhone)</a>
                    </li>
                    <li>
                        <i class="bi bi-tablet-landscape"></i> <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::IPAD]) }}">планшет (iPad)</a>
                    </li>
                </ul>
            </p>
            <p class="card-text">👆 Будь ласка, натисни вище на потрібний пристрій або:</p>
            </div>
            <div class="card-footer text-muted text-center">
                <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Це помилка, оберу інший варіант</a>&nbsp;&nbsp;
                <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::UNKNOWN]) }}">обрати універсальний варіант</a>
            </div>
        {{-- Unsupported device --}}
        @elseif($device['name'] === \App\Support\ClientInfo\Detector::UNKNOWN)
            <h5>{!! $device['icon'] !!} Твій девайс визначити не вдалося.</h5>
            <p class="card-text">
                Можна обрати самостійно або використати універсальний варіант:
            </p>
            </div>
            <div class="card-footer text-muted text-center">
                <a href="{{ route('ddos.software', ['device' => $device['name']]) }}" class="btn btn-outline-primary">Універсальний варіант</a>&nbsp;&nbsp;&nbsp;
                <a data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Оберу самостійно</a>
            </div>
        @else
            <h5 class="text-center">{!! $device['icon'] !!} <b>{{ $device['name'] }}</b>
                @if($device['title']) ({{ $device['title'] }}) @endif
            </h5>
            </div>

            <div class="card-footer text-muted text-center">
                <a href="{{ route('ddos.software', ['device' => $device['name']]) }}" class="btn btn-outline-primary">Так</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('ddos.software', ['device' => $device['name']]) }}">Не знаю</a>&nbsp;&nbsp;
                <a data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Ні, оберу самостійно</a>
            </div>
        @endif
    </div>

    <div class="collapse" id="allDevices">
        <br />
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-apple"></i> OS X</h5>
                        <p class="card-text">Apple Mac, MacBook, Mac mini, iMac</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::OSX]) }}" class="btn btn-outline-primary">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-windows"></i> Windows</h5>
                        <p class="card-text">Звичайний ноутбук чи комп'ютер на Windows</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::WINDOWS]) }}" class="btn btn-outline-primary">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">🐧 Linux</h5>
                        <p class="card-text">Ноутбук, комп'ютер чи інший пристрій на Linux</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::LINUX]) }}" class="btn btn-outline-primary">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-phone"></i> Android</h5>
                        <p class="card-text">Смартфон чи планшет на Android</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::ANDROID]) }}" class="btn btn-outline-primary">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-apple"></i> iOS</h5>
                        <p class="card-text">Смартфон чи планшет на iOS (Apple iPhone, iPad)</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfo\Detector::IOS]) }}" class="btn btn-outline-primary">Обрати</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <code id="debug-data" class="visually-hidden">
        User-agent: {{ $userAgent }}<br />
        Device: {{ $detectedDevice }}<br />
        OS: {{ $os }}<br />
        Browser: {{ $browser }}<br />
        Browser version: {{ $browserVersion }}<br />
        Language: {{ $language }}<br />
        Accepted language: {{ $acceptLanguage }}<br />
        Is mobile: {{ $isMobile ? 'true' : 'false' }}<br />
    </code>
@endsection
