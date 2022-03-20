@extends('layouts.app')

@section('title', __('DDoS attack'))

@section('content')
    <p>Як можна значно ускладнити життя ворогу? <b>Зробімо, щоб їхні важливі для війни сайти не працювали</b>:</p>
    <ul>
        <li>сайти пропаганди (gazeta.ru, ria.ru, smi2.ru, russian.rt.com та інші)</li>
        <li>сайти банків (sber.ru та інші)</li>
        <li>сайти логістики...</li>
        ...та інші, що допомогають фюреру 21-го сторіччя вбивати наших громадян.
    </ul>
    <p>
        Для цього не потрібно бути IT-фахівцем, достатньо "заходити" на ці сайти багато разів (робити на них запити).
        Сервери сайтів не витримають навантаження та перестануть працювати, особливо коли ти доєднаєшся. Це називають <b>DDoS-атакою</b>.
    </p>
    <p>Тож <b>як я можу долучитися до IT-армії?</b> Не переймайся, тобі не потрібно перезавантажувати сторінку мільйон разів, достатньо:</p>
    <ul>
        <li>запустити спеціальну програму <span class="text-muted">або навіть</span></li>
        <li>просто зайти на спеціальний сайт</li>
    </ul>
    <p>Маючи комп'ютер, ноутбук чи смартфон, ти можеш <b>допомогти</b>, не будучі досвідченим користувачем, <b>без спеціальних навичок</b>.</p>
    <p>Для цього потрібні:</p>
    <ul>
        <li>пристрій - комп'ютер чи смартфон;</li>
        <li>інтернет, бажано безлімітний та стабільний/</li>
    </ul>

    <h4>Дуже простий рівень <em>(без VPN, невисока ефективність)</em></h4>

    <ol>
        <li>
            <p>
                <b>Програма UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧) <span class="text-muted">за підтримки Кабінету Міністрів України</span>
            </p>
            <p>
                Все, що потрібно - просто завантажити програму та запустити її (є версії для комп'ютерів Windows, Mac та Linux). Це можна зробити з офіційних джерел:
            </p>
            <p>
                <ul>
                    <li><a target="_blank" href="https://help-ukraine-win.com.ua/help-ukraine-win-ua/1">Інструкції по встановленню</a></li>
                    <li><a href="https://t.me/uashield" target="_blank">Телеграм-канал</a></li>
                    <li><a href="https://github.com/opengs/uashield/releases/latest" target="_blank">Github releases</a></li>
                </ul>
            </p>
            <p>Як це працює? Атакує певний перелік сайтів, який самостійно динамічно змінюється, із
                використанням проксі, тож ти в безпеці - твою <b>IP-адресу та місцезнаходження приховано</b>.
            </p>
        </li>
    </ol>

    <p>Це все! Проте для більш ефективних атак використовуй простий та досвічений рівні:</p>

    <details>
        <summary><h5><i class="bi bi-caret-down-square"></i> Простий та досвічений рівні - натисни сюди <i class="bi bi-caret-down-square"></i></h5></summary>
        <p>
            <b>!!! Для простого та досвіченого рівнів потрібно встановити VPN.</b>
        </p>

        <h4>Як встановити VPN</h4>
        <p>
            <b>Найпростіший варіант</b> - це <a href="https://www.torproject.org/ru/download/">Tor Browser</a> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i> <i class="bi bi-phone"></i>🐧).
            Після завантаження в ньому ж відкрити вкладку із сайтами, які наведені нижче ("Простий рівень") й насолоджуватися атаками на російські сайти.
            При кожному новому входженні в браузер ваша IP буде мінятися. Є версія також для смартфонів - ти можеш відкрити сайти зі списку нижче на своєму смартфоні!
        </p>
        <p>
            Інші варіанти докладно описані тут: <a href="/files/DDOS_Tutorial_for_all.pdf" target="_blank">DDOS_Tutorial_for_all.pdf</a> <em>(сторінки 2-4)</em> - список сервісів з коментарями, переліком переваг та недоліків.
            Наявні як платні, так і безплатні варіанти.
            Використовуйте російські, білоруські локації для найбільшої ефективності (або будь-які інші окрім української). Я використовую <a href="https://www.cyberghostvpn.com/">CyberGhost VPN</a> (платний, проте добре працює, є багато країн).
        </p>

        <h4>Простий рівень <em>(невисока ефективність)</em></h4>
        <ol>
            <li>
                <p>
                    <b><a href="https://павутина.укр/" target="_blank">https://павутина.укр/</a></b><br />
                    Атакує певний перелік російських сайтів, який можна змінювати.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://www.lookquizru.xyz/" target="_blank">https://www.lookquizru.xyz/</a></b><br />
                    Атакує один із сайтів, який є актуальний на цей час (сайт для атаки динамічно змінюється).<br />
                    Сайт розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi">Посилання на їх Телеграм-канал</a>.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://2022pollquizinru.xyz/" target="_blank">https://2022pollquizinru.xyz</a></b><br />
                    Атакує стандартний перелік російських сайтів.<br />
                    Ще один сайт, розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi">Посилання на їх Телеграм-канал</a>.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://playforukraine.live/" target="_blank">https://playforukraine.live</a></b><br />
                    І таке навіть створили!
                    Гра, яку можна грати в браузері, а кожен твій крок проводить атаку на один із російських сайтів.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://stop-russian-propaganda.pp.ua/" target="_blank">https://stop-russian-propaganda.pp.ua</a></b><br />
                    Атакує стандартний перелік російських сайтів.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="https://ban-dera.com/" target="_blank">https://ban-dera.com</a></b><br />
                    Атакує стандартний перелік російських сайтів. <a href="https://github.com/vnestoruk/ban-dera" target="_blank">Github</a><br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b><a href="http://www.notwar.ho.ua/" target="_blank">http://www.notwar.ho.ua</a></b><br />
                    Атакує стандартний перелік російських сайтів.<br />
                    <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                    <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                </p>
            </li>
            <li>
                <p>
                    <b>Програма DB1000N</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
                </p>
                <p>
                    <b>Не забувайте про увімкнений VPN! Tor Browser тут використовувати не доцільно,</b> адже він працює тільки на сайтах зі списка вище (для програм не працює)!
                </p>
                <p>
                    Атакує певний перелік сайтів, який самостійно динамічно змінюється.
                    Програма розроблена командою DDOS по країні СЕПАРІВ (Кібер-Козаки). Завантажити:
                </p>
                <p>
                    <ul>
                        <li><a href="https://telegra.ph/Death-by-1000-needles-03-17" target="_blank">Інструкції по встановленню</a></li>
                        <li><a href="https://t.me/ddos_separ" target="_blank">Телеграм-канал</a></li>
                        <li><a href="https://github.com/Arriven/db1000n/releases/latest" target="_blank">Github releases</a></li>
                    </ul>
                </p>
            </li>
            <li>
                <p>
                    <b>Програма UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
                </p>
                <p>
                    Описана в розділі "Дуже простий рівень", проте можна підвищити її ефективність, ввімкнувши VPN замість проксі.
                </p>
                <p>
                    <ul>
                        <li>
                            <a href="https://help-ukraine-win.com.ua/help-ukraine-win-en/2-vpn" target="_blank">Інструкції по встановленню</a>
                        </li>
                        <li>
                            <a href="https://help-ukraine-win.com.ua/639463cfe94541578431034bac9da90a" target="_blank">Як перейти із використання проксі на VPN?</a>
                        </li>
                    </ul>
                </p>
            </li>
        </ol>
        <h4>Більш складні рівні атаки <em>(найвища ефективність)</em></h4>
        <p>
            Детально почитати про <b>MHDDoS, alpine/bombardier, LOIC, атаку через хмарні сервери (AWS, Azure, Digital Ocean)</b>:
        </p>
        <ul>
            <li>
                <p>
                    Для найбільш ефективних та складних атак через програми та скрипти та координування атак дивися документ: <a href="https://t.me/c/1581802346/35" target="_blank">Telegram-повідомлення</a> <em>(починаючи з 9 сторінки)</em>.<br />
                    <span class="text-muted">Якщо телеграм-група недоступна: <a href="/files/DDOS_Tutorial_for_all.pdf" target="_blank">остання збережена версія</a></span>
                </p>
            </li>
            <li>
                <p>
                    Python-розробникам та всім, хто може запустити Python-скрипт:
                    просте та досить конфігураційне рішення: <a href="https://gist.github.com/NewEXE/a284a7ca0c3a2ddd2894907bb1787c63" target="_blank">gist.github.com </a>.
                    Потрібен Docker та Python 2.7 або 3.
                </p>
            </li>
            <li>
                <p>
                    <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua/3" target="_blank">Детально про реєстрацію на Microsoft Azure</a>. Також на сайті обширне FAQ.
                </p>
            </li>
            <li>
                <p>
                    Інші способи атаки: <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua" target="_blank">тут</a> та <a href="https://github.com/SlavaUkraineSince1991/DDoS-for-all" target="_blank">тут</a>
                </p>
            </li>
        </ul>
    </details>
@endsection
