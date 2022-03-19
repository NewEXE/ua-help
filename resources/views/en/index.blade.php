@extends('layouts.app')

@section('title', 'Home')

@section('top-menu')
    <p>Top-menu</p>
@endsection

@section('content')
    <p>Home content.</p>
    {{ app()->getLocale() }}
@endsection
