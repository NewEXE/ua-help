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
                        <i class="bi bi-wifi-off"></i> <a href="{{ route('ddos.intro') }}">DDoS-атака на пропагандисьтскі сайти</a> (доступно кожному)<br>
                        <i class="bi bi-youtube"></i> <a href="{{ route('pages.news-channels') }}">Де дивитися телебачення та читати новини?</a>
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
                                <i class="bi-exclamation-circle"></i> <a href="{{ route('pages.no-connection')  }}">Якщо пропав мобільний зв'язок чи інтернет</a>
                            </li>
                            <li>
                                <a href="https://viyna.net/" target="_blank">Платформа для швидкого пошуку інформації під час війни</a>
                            </li>
                            <li>
                                <a href="https://docs.google.com/document/d/1EwQfPwLgnosVxW4S8cZtcVyamuB6AFv-i5HJ-zLTWwk" target="_blank">Центр корисних посилань</a>
                            </li>
                            <li>
                                <a href="https://www.google.com/maps/d/viewer?mid=10_NljhEirUHL7BK5ndGovi-3vUorrXjY&fbclid=IwAR2uqrei-A4cpk8tkSl6WAbBXAs09kLUz8RT4W5MCVksnLIhz9RtW_orJEA&ll=49.40792967535675%2C36.82931744999999&z=8" target="_blank">Харків: карта магазинів, АЗС, аптек що працюють</a>
                            </li>
                            <li>
                                <a href="https://bit.ly/3txFhc0" target="_blank">Українцям за кордоном</a>
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
