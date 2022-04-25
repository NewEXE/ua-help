@extends('layouts.app')

@section('content')
    <p class="lead">Якщо ви використовуєте програми для атаки (UA Cyber SHIELD, db1000n та інші)</p>
        <p>
            Варіанти:
        <ul>
            <li>
                <a href="https://viyna.net/203a9165b61042b7ae5efe6446dbfb76" target="_blank">Перелік безплатних VPN-сервісів для українців</a></li>
            <li><a href="https://arriven.github.io/db1000n/uk/#як-обрати-vpn" target="_blank">Ще один перелік безплатних VPN-сервісів</a></li>
            <li><a href="/files/DDOS_Tutorial_for_all.pdf" target="_blank">DDOS_Tutorial_for_all.pdf</a> <em>(сторінки 2-4)</em> - список сервісів з коментарями, переліком переваг та недоліків.</li>
            <li><a href="{{ route('view.file', ['f' => 'VPN-advanced.txt']) }}" target="_blank">Незвичні, "продвинуті" варіанти VPN-сервісів</a></li>
        </ul>
        <p>
            Наявні як платні, так і безплатні варіанти.
            Особисто я використовую <a href="https://www.cyberghostvpn.com/" target="_blank">CyberGhost VPN</a> (платний, проте добре працює, є багато країн).
        </p>
        <p>
            <b>Важливо:</b> використовуйте російські, білоруські, китайські локації для найбільшої ефективності (або будь-які інші окрім української) - тоді ваша IP-адреса буде вважатися "дружньою".
            Не забувай змінювати VPN країну кожні годину-дві, адже сайти ворога блокують IP-адреси, з яких ідуть атаки та вони стають менш ефективними.
        </p>

    <p class="lead">Якщо ви використовуєте веб-сайти для атаки (ban-dera.com, stop-russian-propaganda.pp.ua та інші)</p>
    <p>
        <b>Найпростіший варіант</b> - це <a href="https://www.torproject.org/ru/download/" target="_blank">Tor Browser</a> (для iPhone/iPad використовуйте <a href="https://apps.apple.com/ru/app/onion-browser/id519296448" target="_blank">Onion Browser</a>).
        Після завантаження в ньому ж відкрити вкладку з сайтом, який призводить атаку на російські сайти (<a href="{{ route('ddos.software', ['device' => \App\Support\ClientInfoDetector::UNKNOWN]) }}">перелік цих сайтів тут</a>).
        При кожному новому входженні в браузер IP-адреса буде змінюватися. Є версія браузеру для будь-якого девайсу.
        <b>Важливо!</b> Перевірте, чи змінилася ваше місцеположення: зайдіть на <a href="https://2ip.ru" target="_blank">2ip.ru</a> заходячи з Tor Browser (чи Onion Browser).
    </p>
    <p>
        <b>Важливо:</b> не забувай періодично закривати та знов відкривати Tor/Onion Browser, адже сайти ворога блокують IP-адреси, з яких ідуть атаки та атаки стають менш ефективними.
    </p>
@endsection
