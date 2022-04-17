@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            Крок 1/3. Опис атак
        </div>
        <div class="card-body">
            <h5 class="card-title">Як атакувати російські сайти</h5>
            <p class="card-text">
                опис ддос-атак
            </p>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('ddos.select-device') }}" class="btn btn-primary">Приєднатися</a>
        </div>
    </div>
@endsection
