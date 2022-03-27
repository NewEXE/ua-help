@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-laptop"></i> <b>Інформаційна боротьба</b>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        допомогти в мережі
                    </h6>
                    <p class="card-text">
                        <i class="bi bi-wifi-off"></i> <a href="{{ route('pages.ddos') }}">DDoS-атака на пропагандисьтскі сайти</a> (доступно кожному)
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-life-preserver"></i> <b class="text-warning">Мені потрібна допомога!</b>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        тобі потрібно (або ти можеш) допомогти?
                    </h6>
                    <p class="card-text">
                        <ul style="padding-left: 10px">
                            <li>
                                <a href="https://viyna.net/" target="_blank">Платформа для швидкого пошуку інформації під час війни</a>
                            </li>
                            <li>
                                <a href="https://www.google.com/maps/d/u/0/viewer?mid=10_NljhEirUHL7BK5ndGovi-3vUorrXjY&ll=49.99162209999801%2C36.30752944638234&z=12" target="_blank">Харків: карта магазинів, АЗС, аптек що працюють</a>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-cash-coin"></i> <b>Фінансова підтримка</b>
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
