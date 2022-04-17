@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">

        </div>
        <div class="card-body">
            <h5 class="card-title text-center"><b>{{ $detectedDevice }}</b></h5>
            <p class="card-text">
                User-agent: {{ $userAgent }}<br />
                Device: {{ $device }}<br />
                OS: {{ $os }}<br />
                Browser: {{ $browser }}<br />
                Language: {{ $lang }}<br />
            </p>
        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
@endsection
