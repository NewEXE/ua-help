@extends('layouts.app')

@section('title', __('How to help Ukraine?'))

@section('content')
    <h4><i class="bi bi-cash-coin"></i> Фінансова підтримка</h4>
    <p>
        Офіційні реквізити: <a href="https://bank.gov.ua/en/news/all/natsionalniy-bank-vidkriv-spetsrahunok-dlya-zboru-koshtiv-na-potrebi-armiyi" target="_blank">bank.gov.ua</a>
        <i class="bi bi-box-arrow-up-right"></i>
    </p>
    <h4><i class="bi bi-hash"></i> Інформаційна боротьба</h4>
    <p>
        <i class="bi bi-server"></i> <a href="{{ route('pages.ddos') }}">Атака на пропагандисьтскі сайти</a> (доступно кожному)
    </p>
@endsection
