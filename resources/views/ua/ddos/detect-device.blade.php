@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">

        </div>
        <div class="card-body">
            <h5 class="card-title text-center"><b>{{ $device }}</b></h5>
            <p class="card-text">
                {{ Request::userAgent() }}
            </p>
        </div>
        <div class="card-footer text-muted text-center">

        </div>
    </div>
@endsection
