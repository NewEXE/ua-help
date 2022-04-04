@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">

        </div>
        <div class="card-body">
            <h5 class="card-title text-center"><b></b></h5>
            <p class="card-text">
                Device: {{ $device->getName() }}<br />
                OS: {{ $os->getName() }}<br />
                Browser: {{ $browser->getName() }}<br />
                Language: {{ $lang->getLanguage() }}<br />
            </p>
        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
@endsection
