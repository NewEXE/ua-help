@extends('layouts.app')

@section('title', 'Головна')

@section('top-menu')
    <p>Топ-меню</p>
@endsection

@section('content')
    <p>Контент.</p>
    {{ app()->getLocale() }}
@endsection
