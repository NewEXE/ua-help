@extends('layouts.app')

@section('content')
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
    <div class="card text-center">
        <div class="card-header">
            The preferred way:
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>Real ways you can help Ukraine as a foreigner</b></h5>
            <p class="card-text">
                <blockquote class="blockquote">
                    👋 Hello, we are a crowdsourced information platform with the most comprehensive list: official funds, requests, materials (doc updated live, hourly).
                Please be aware that it’s a crowdsourced effort, we have limited capacity for quality assurance and can make mistakes. If you see one – let us know and we’ll resolve that.
                </blockquote>
            </p>
            <a href="https://supportukrainenow.org/" class="btn btn-primary">Support Ukraine NOW</a>
        </div>
        <div class="card-footer text-muted">
            Other ways:
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-laptop"></i> <b>Information war</b>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        web assisting
                    </h6>
                    <p class="card-text">
                        <i class="bi bi-wifi-off"></i> <a href="{{ route('pages.ddos') }}">DDoS attack to russian propaganda</a> (easy to join)
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-cash-coin"></i> <b>Financial support</b>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        send money
                    </h6>
                    <p class="card-text">
                        Official Ukrainian army payment details:
                        <a href="https://bank.gov.ua/en/news/all/natsionalniy-bank-vidkriv-spetsrahunok-dlya-zboru-koshtiv-na-potrebi-armiyi" target="_blank">bank.gov.ua</a> /
                        <a href="https://helpua.bank.gov.ua/" target="_blank">helpua.bank.gov.ua</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
