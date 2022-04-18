@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Крок 1/3. Опис атак
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">⚔️Приєднуйся до IT-армії! 🛡</h5>
            <p class="card-text">
                Як можна значно ускладнити життя ворогу? <b>Зробімо, щоб їхні важливі для війни сайти не працювали</b>:
                <ul>
                    <li>урядові сайти (kremlin.ru та інші)</li>
                    <li>банківські системи (sber.ru та інші)</li>
                    <li>пропагандистські ресурси (kremlin.ru, gazeta.ru, ria.ru, smi2.ru, rt.com та інші)</li>
                    <li>сайти логістики...</li>
                </ul>
                ...та інші, що допомогають фюреру 21-го сторіччя вбивати наших громадян.<br /><br />
                Це простіше, ніж ти думаєш. Достатньо приєднатися до DDoS-атаки.<br />
                Атака DDoS робить величезну кількість запитів на ворожі сайти та спричиняє їх надмірну завантаженість.
                Як наслідок, сервери не встигають обробляти всі запити, тому не можуть працювати в штатному режимі, лагають або взагалі не працюють.<br /><br />
                Приєднайся у два простих кроки:
            </p>
        </div>
        <div class="card-footer text-muted text-center">
            <a href="{{ route('ddos.select-device') }}" class="btn btn-info">🇺🇦 Приєднатися</a>
        </div>
    </div>
@endsection
