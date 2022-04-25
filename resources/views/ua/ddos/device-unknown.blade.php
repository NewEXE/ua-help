@extends('layouts.app')

@section('content')
    <div>
        <h4>Універсальний варіант</h4>
        <p>
            Почати атаку можна з будь-якого девайсу.
            Наші спеціалісти розробили веб-сервіси, котрі автоматично атакують російські ресурси.
            Що потрібно зробити - встановити VPN та зайти на будь-який сайт зі списку нижче.
        </p>

        <p class="lead">1. Встановити VPN:</p>
        <p>
            <b>Найпростіший варіант</b> - це <a href="{{ $torData['link'] }}" target="_blank">{{ $torData['name'] }}</a>.
            Після завантаження відкрийте програму та уже в ній відкривайте сайти, які призводить атаку на російські ресурси (перелік таких сайтів нижче).
            <b>Важливо!</b> Перед тим, як відкрити сайт, перевірте, чи змінилася ваше місцеположення: зайдіть на <a href="https://2ip.ru" target="_blank">2ip.ru</a>.
            <a href="{{ route('pages.vpn') }}">Інші варіанти VPN для українців</a>.
        </p>
        <p>
            <b>Важливо:</b> не забувайте періодично закривати та знов відкривати {{ $torData['name'] }}, адже сайти ворога блокують IP-адреси, з яких ідуть атаки та атаки стають менш ефективними.
        </p>

        <p class="lead">2. Зайти на будь-який сайт:</p>
        <p>Деякі сайти можуть інколи не працювати. Перед тим, як перейти на сайт, уважно прочитайте його опис.</p>
        <ol>
            <li>
                <p>
                    <b><a href="https://ban-dera.com/" target="_blank">https://ban-dera.com</a></b><br />
                    Атакує певний перелік російських сайтів, який можна змінювати. <a href="https://github.com/vnestoruk/ban-dera" target="_blank">Github</a><br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://павутина.укр/" target="_blank">https://павутина.укр/</a></b><br />
                    Атакує певний перелік російських сайтів, який можна змінювати.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://www.lookquizru.xyz/" target="_blank">https://www.lookquizru.xyz/</a></b><br />
                    Атакує один із сайтів, який є актуальний на цей час (сайт для атаки динамічно змінюється).<br />
                    Сайт розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi" target="_blank">Посилання на їх Телеграм-канал</a>.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://2022pollquizinru.xyz/" target="_blank">https://2022pollquizinru.xyz</a></b><br />
                    Атакує стандартний перелік російських сайтів.<br />
                    Ще один сайт, розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi" target="_blank">Посилання на їх Телеграм-канал</a>.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://playforukraine.live/" target="_blank">https://playforukraine.live</a></b><br />
                    І таке навіть створили!
                    Гра, яку можна грати в браузері, а кожен твій крок проводить атаку на один із російських сайтів.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://stop-russian-propaganda.pp.ua/" target="_blank">https://stop-russian-propaganda.pp.ua</a></b><br />
                    Атакує стандартний перелік російських сайтів.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="http://www.notwar.ho.ua/" target="_blank">http://www.notwar.ho.ua</a></b><br />
                    Атакує стандартний перелік російських сайтів.
                    <a href="https://t.me/ddos_for_all/80?comment=931" target="_blank">Щодо ефективності є сумніви</a>.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://stop-russian-desinformation.near.page/" target="_blank">https://stop-russian-desinformation.near.page</a></b><br />
                    Атакує стандартний перелік російських сайтів.
                    <a href="https://github.com/dustinbaer/stop-russian-disinformation" target="_blank">Github</a>.
                    <a href="https://t.me/ddos_for_all/35?comment=2160" target="_blank">Щодо ефективності є сумніви</a>.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або {{ $torData['name'] }}, у який потрібно час від часу перезаходити!
                </p>
            </li>
        </ol>
        <p class="lead">Більш складні рівні атаки (найвища ефективність): <a href="{{ route('pages.ddos') }}">Велика інструкція по DDoS</a></p>
    </div>
@endsection
