@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            Крок 2/3. Обрати девайс
        </div>

        {{-- Ambigous device (OS X or iOS) --}}
        @if(in_array($device['name'], [\App\Support\ClientInfoDetector::OSX, \App\Support\ClientInfoDetector::IOS], true))
            <div class="card-body">
                <h5 class="card-title">{!! $device['icon'] !!} Ваш девайс - пристрій на <b>{{ $device['name'] }}</b></h5>
                <p class="card-text">
                    Це може бути:<br />
                    <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::IPHONE]) }}">смартфон (iPhone)</a><br />
                    <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::IPAD]) }}">планшет (iPad)</a><br />
                    @if($device['name'] === \App\Support\ClientInfoDetector::OSX)
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::OSX]) }}">ноутбук (MacBook)</a><br />
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::OSX]) }}">комп'ютер (Mac, Mac mini, iMac)</a><br />
                    @endif
                </p>
            </div>
            <div class="card-footer text-muted">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Це помилка, оберу інший варіант</a> або
                <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::UNKNOWN]) }}">обрати універсальний варіант</a>
            </div>
        {{-- Unsupported device --}}
        @elseif($device['name'] === \App\Support\ClientInfoDetector::UNKNOWN)
            <div class="card-body">
                <h5 class="card-title">{!! $device['icon'] !!} Визначити пристрій автоматично не вдалося</h5>
                <p class="card-text">
                    Можна обрати девайс самостійно чи обрати універсальний варіант
                </p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('ddos.software', ['device' => $device['name']]) }}" class="btn btn-primary">Універсальний варіант</a>&nbsp;&nbsp;&nbsp;
                <a data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Оберу самостійно</a>
            </div>
        @else
            <div class="card-body">
                <h5 class="card-title">{!! $device['icon'] !!} Ваш пристрій - <b>{{ $device['name'] }}</b>?</h5>
                <p class="card-text">
                    Чи правильно ми визначили ваш девайс? {{ $device['title'] }}
                </p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('ddos.software', ['device' => $device['name']]) }}" class="btn btn-primary">Так</a>&nbsp;&nbsp;&nbsp;
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
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::OSX]) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-windows"></i> Windows</h5>
                        <p class="card-text">Звичайний ноутбук чи комп'ютер на Windows</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::WINDOWS]) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">🐧 Linux</h5>
                        <p class="card-text">Ноутбук, комп'ютер чи інший пристрій на Linux</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::LINUX]) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-phone"></i> Android</h5>
                        <p class="card-text">Смартфон чи планшет на Android</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::ANDROID]) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-apple"></i> iOS</h5>
                        <p class="card-text">Смартфон чи планшет на iOS (Apple iPhone, iPad)</p>
                        <a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::IOS]) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="debug-data" class="visually-hidden">
        User-agent: {{ $userAgent }}<br />
        Device: {{ $detectedDevice }}<br />
        OS: {{ $os }}<br />
        Browser: {{ $browser }}<br />
        Language: {{ $language }}<br />
    </span>
@endsection
