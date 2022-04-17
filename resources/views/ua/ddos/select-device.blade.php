@extends('layouts.app')

@php
$icon = '';
switch ($detectedDevice) {
    case 'iPhone':
    case 'iPad':
    case 'iOS':
    case 'OS X':
        $icon = '<i class="bi bi-apple"></i>';
        break;
    case 'Windows':
    case 'Windows Phone':
        $icon = '<i class="bi bi-windows"></i>';
        break;
    case 'Android':
        $icon = '<i class="bi bi-phone"></i>';
        break;
    case 'Linux':
        $icon = '🐧';
        break;
}
@endphp

@section('content')
    <div class="card text-center">
        <div class="card-header">
            Крок 2/3. Обрати девайс
        </div>

        @if($detectedDevice === 'OS X')
            <div class="card-body">
                <h5 class="card-title">{!! $icon !!} Ваш девайс - пристрій на <b>Mac OS X</b></h5>
                <p class="card-text">
                    Це може бути:<br />
                    ноутбук (MacBook)<br />
                    планшет (iPad)<br />
                    смартфон (iPhone)<br />
                    комп'ютер (Mac, Mac mini, iMac)
                </p>
            </div>
            <div class="card-footer text-muted">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Це помилка, оберу інший варіант</a> або
                <a href="{{ route('ddos.software', ['device' => 'unknown']) }}">обрати універсальний варіант</a>&nbsp;&nbsp;&nbsp;
            </div>
        @elseif($detectedDevice === 'unknown')
            <div class="card-body">
                <h5 class="card-title">Визначити пристрій автоматично не вдалося</h5>
                <p class="card-text">
                    Можна обрати девайс самостійно чи обрати універсальний варіант
                </p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('ddos.software', ['device' => 'unknown']) }}" class="btn btn-primary">Універсальний варіант</a>&nbsp;&nbsp;&nbsp;
                <a data-bs-toggle="collapse" href="#allDevices" role="button" aria-expanded="false" aria-controls="allDevices">Оберу самостійно</a>
            </div>
        @else
            <div class="card-body">
                <h5 class="card-title">{!! $icon !!} Ваш пристрій - <b>{{$detectedDevice}}</b>?</h5>
                <p class="card-text">
                    Чи правильно ми визначили ваш девайс?
                </p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('ddos.software', ['device' => $detectedDevice]) }}" class="btn btn-primary">Так</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('ddos.software', ['device' => $detectedDevice]) }}">Не знаю</a>&nbsp;&nbsp;
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
                        <a href="{{ route('ddos.software', ['device' => 'OS X']) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-windows"></i> Windows</h5>
                        <p class="card-text">Звичайний ноутбук чи комп'ютер на Windows</p>
                        <a href="{{ route('ddos.software', ['device' => 'Windows']) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">🐧 Linux</h5>
                        <p class="card-text">Ноутбук, комп'ютер чи інший пристрій на Linux</p>
                        <a href="{{ route('ddos.software', ['device' => 'Linux']) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-phone"></i> Android</h5>
                        <p class="card-text">Смартфон чи планшет на Android</p>
                        <a href="{{ route('ddos.software', ['device' => 'unknown']) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-apple"></i> iOS</h5>
                        <p class="card-text">Смартфон чи планшет на iOS (Apple iPhone, iPad)</p>
                        <a href="{{ route('ddos.software', ['device' => 'unknown']) }}" class="btn btn-outline-light">Обрати</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="debug-data" class="visually-hidden">
        User-agent: {{ $userAgent }}<br />
        Device: {{ $device }}<br />
        OS: {{ $os }}<br />
        Browser: {{ $browser }}<br />
        Language: {{ $lang }}<br />
    </span>
@endsection
