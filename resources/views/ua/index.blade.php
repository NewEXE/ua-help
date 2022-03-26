@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-hash"></i> Інформаційна боротьба
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        допомогти в мережі
                    </h6>
                    <p class="card-text">
                        <i class="bi bi-server"></i> <a href="{{ route('pages.ddos') }}">Атака на пропагандисьтскі сайти</a> (доступно кожному)
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-cash-coin"></i> Фінансова підтримка
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        надіслати гроші
                    </h6>
                    <p class="card-text">
                        Офіційні реквізити української армії: <a href="https://bank.gov.ua/en/news/all/natsionalniy-bank-vidkriv-spetsrahunok-dlya-zboru-koshtiv-na-potrebi-armiyi" target="_blank">bank.gov.ua</a> /
                        <a href="https://helpua.bank.gov.ua/" target="_blank">helpua.bank.gov.ua</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
