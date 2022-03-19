@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>{{ __('How to help Ukraine?') }}</h3></div>

                    <div class="card-body">
                        <p>There is a war in Ukraine right now.</p>
                        <p>
                            The forces of the Russian Federation are attacking civilian infrastructure in Kharkiv, Kyiv, Chernihiv, Sumy, Irpin and dozens of other cities.
                            People are dying – both civilians and military servicemen, including Russian conscripts who were thrown into the fighting.
                        </p>
                        <p>
                            In order to deprive its own people of access to information, the government of the Russian Federation has forbidden calling a war, shut down independent media and is passing a number of dictatorial laws.
                            These laws are meant to silence all those who are against war.
                            You can be jailed for multiple years for simply calling for peace.
                            Do not be silent! Silence is a sign that you accept the Russian government's policy.
                        </p>
                        <p><b>You can choose NOT TO BE SILENT.</b></p>
                        <h4><i class="bi bi-cash-coin"></i> Financial support</h4>
                        <p>
                            Official payment details: <a href="https://bank.gov.ua/en/news/all/natsionalniy-bank-vidkriv-spetsrahunok-dlya-zboru-koshtiv-na-potrebi-armiyi" target="_blank">bank.gov.ua</a>
                            <i class="bi bi-box-arrow-up-right"></i>
                        </p>
                        <h4><i class="bi bi-hash"></i> Information war</h4>
                        <p>
                            <i class="bi bi-server"></i> <a href="{{ route('pages.ddos') }}">DDoS attack to russian propaganda</a> (easy to join)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
