@extends('layouts.app')

@section('content')
    <p>Як можна значно ускладнити життя ворогу? <b>Зробімо, щоб їхні важливі для війни сайти не працювали</b>:</p>
    <ul>
        <li>сайти пропаганди (kremlin.ru, gazeta.ru, ria.ru, smi2.ru, russian.rt.com та інші)</li>
        <li>сайти банків (sber.ru та інші)</li>
        <li>сайти логістики...</li>
        ...та інші, що допомогають фюреру 21-го сторіччя вбивати наших громадян.
    </ul>
    <p>
        Для цього не потрібно бути IT-фахівцем, достатньо "заходити" на ці сайти багато разів (робити на них запити).
        Сервери сайтів не витримають навантаження та перестануть працювати, особливо коли ти доєднаєшся. Це називають <b>DDoS-атакою</b>.
    </p>
    <p>
        Атака DDoS робить величезну кількість запитів на ворожі сайти та спричиняє їх надмірну завантаженість.
        Як наслідок, сервери не встигають обробляти всі запити, тому не можуть працювати в штатному режимі, лагають або взагалі не працюють
    </p>
    <p>Тож <b>як я можу долучитися до IT-армії?</b> Не переймайся, тобі не потрібно перезавантажувати сторінку мільйон разів, достатньо:</p>
    <ul>
        <li>запустити спеціальну програму <span class="text-muted">або навіть</span></li>
        <li>просто зайти на спеціалізований сайт</li>
    </ul>
    <p>Маючи комп'ютер, ноутбук чи смартфон, ти можеш <b>допомогти</b>, не будучі досвідченим користувачем, <b>без спеціальних навичок</b>.</p>
    <p>Для цього потрібні:</p>
    <ul>
        <li>пристрій - комп'ютер, ноутбук чи смартфон;</li>
        <li>інтернет, бажано безлімітний та стабільний.</li>
    </ul>

    <h4>Дуже простий рівень <em>(без VPN)</em></h4>

    <ol>
        <li>
            <p>
                <b>Програма UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧) <span class="text-muted">за підтримки кабміну України</span>
            </p>
            <p>
                Все, що потрібно - просто завантажити програму та запустити її (є версії для комп'ютерів Windows, Mac та Linux).
                Це можна зробити з офіційних джерел:
            </p>
            <p>
                <ul>
                    <li><i class="bi bi-download"></i> <a href="/files/UA-Cyber-SHIELD-Setup.exe">Завантажити для Windows</a> (остання версія)</li>
                    <li>
                        Потрібна допомога чи інша версія? <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua/1" target="_blank">Докладна інструкція по встановленню</a>
                    </li>
                    <li><a href="https://t.me/uashield" target="_blank">Телеграм-канал</a></li>
                </ul>
            </p>
            <p>
                Як це працює?
                Атакує певний перелік сайтів, який самостійно динамічно змінюється, із використанням проксі, тож ти в безпеці - твою <b>IP-адресу та місцеперебування приховано</b>.
                <a href="https://github.com/opengs/uashield" target="_blank">This is open-source software</a>.
            </p>
        </li>
    </ol>

    <p>Це все! Проте для більш ефективних атак використовуй простий та досвічений рівні:</p>

    <div class="spoiler">
        <input type="checkbox" id="other-attack-levels">
        <label for="other-attack-levels">
            <h5>
                <i class="bi bi-caret-right-square"></i>
                <span class="link-primary text-decoration-underline">Відкрити простий та досвічений рівні - натисни сюди</span>
                <i class="bi bi-caret-left-square"></i>
            </h5>
        </label>
        <div>
            <p>
                <b>!!! Для простого та досвіченого рівнів потрібно встановити VPN.</b>
            </p>

            <h4>Як встановити VPN</h4>
            <p>
                <b>Найпростіший варіант</b> - це <a href="https://www.torproject.org/ru/download/" target="_blank">Tor Browser</a> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i> <i class="bi bi-phone"></i>🐧).
                Після завантаження в ньому ж відкрити вкладку із сайтами, які наведені нижче ("Простий рівень") й насолоджуватися атаками на російські сайти.
                При кожному новому входженні в браузер ваша IP буде мінятися. Є версія також для смартфонів - ти можеш відкрити сайти зі списку нижче на своєму смартфоні!
            </p>
            <p>
                Інші варіанти:
                <ul>
                <li>
                    <a href="https://viyna.net/203a9165b61042b7ae5efe6446dbfb76" target="_blank">Перелік безплатних VPN-сервісів для українців</a></li>
                    <li><a href="https://arriven.github.io/db1000n/uk/#як-обрати-vpn" target="_blank">Ще один перелік безплатних VPN-сервісів</a></li>
                    <li><a href="/files/DDOS_Tutorial_for_all.pdf" target="_blank">DDOS_Tutorial_for_all.pdf</a> <em>(сторінки 2-4)</em> - список сервісів з коментарями, переліком переваг та недоліків.</li>
                    <li><a href="{{ route('view.file', ['f' => 'VPN-advanced.txt']) }}" target="_blank">Незвичні, "продвинуті" варіанти VPN-сервісів</a></li>
                </ul>
                Наявні як платні, так і безплатні варіанти.
                Використовуйте російські, білоруські локації для найбільшої ефективності (або будь-які інші окрім української).
                Особисто я використовую <a href="https://www.cyberghostvpn.com/" target="_blank">CyberGhost VPN</a> (платний, проте добре працює, є багато країн).
            </p>

            <h4>Простий рівень <em>(невисока ефективність)</em></h4>
            <p>Після ввімкнення VPN наші сайти до ваших послуг:</p>
            <ol>
                <li>
                    <p>
                        <b><a href="https://ban-dera.com/" target="_blank">https://ban-dera.com</a></b><br />
                        Атакує певний перелік російських сайтів, який можна змінювати. <a href="https://github.com/vnestoruk/ban-dera" target="_blank">Github</a><br />
                        <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                        <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                    </p>
                </li>
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
                        Сайт розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi" target="_blank">Посилання на їх Телеграм-канал</a>.<br />
                        <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                    </p>
                </li>
                <li>
                    <p>
                        <b><a href="https://2022pollquizinru.xyz/" target="_blank">https://2022pollquizinru.xyz</a></b><br />
                        Атакує стандартний перелік російських сайтів.<br />
                        Ще один сайт, розроблений командою KiberBULL. <a href="https://t.me/+NdmAn-xnANNlYjJi" target="_blank">Посилання на їх Телеграм-канал</a>.<br />
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
                        <b><a href="http://www.notwar.ho.ua/" target="_blank">http://www.notwar.ho.ua</a></b><br />
                        Атакує стандартний перелік російських сайтів.
                        <a href="https://t.me/ddos_for_all/80?comment=931" target="_blank">Щодо ефективності є сумніви</a>.<br />
                        <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                        <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                    </p>
                </li>
                <li>
                    <p>
                        <b><a href="https://stop-russian-desinformation.near.page/" target="_blank">https://stop-russian-desinformation.near.page</a></b><br />
                        Атакує стандартний перелік російських сайтів.
                        <a href="https://github.com/dustinbaer/stop-russian-disinformation" target="_blank">Github</a>.
                        <a href="https://t.me/ddos_for_all/35?comment=2160" target="_blank">Щодо ефективності є сумніви</a>.<br />
                        <span class="text-danger">Увага!</span> Після відкриття цього сайту ваш ноутбук, або комп'ютер може виснути, будьте обережні.<br />
                        <span class="text-warning">Важливо!</span> Не забувайте про увімкнений VPN, який потрібно час від часу змінювати, або Tor Browser, у який потрібно час від часу перезаходити!
                    </p>
                </li>
                <li>
                    <p>
                        <b>Програма DB1000N</b> (Death by 1000 needles) ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
                    </p>
                    <p>
                        <b>Не забувайте про увімкнений VPN! Tor Browser тут використовувати не доцільно,</b> адже він працює тільки на сайтах з переліку вище (для програм не працює)!
                    </p>
                    <p>
                        Атакує певний перелік сайтів, який самостійно динамічно змінюється.
                        Програма розроблена командою DDOS по країні СЕПАРІВ (Кібер-Козаки). Завантажити:
                    </p>
                    <p>
                    <ul>
                        <li><a href="https://arriven.github.io/db1000n/uk" target="_blank">Інструкції по встановленню</a></li>
                        <li><a href="https://telegra.ph/Death-by-1000-needles-03-17" target="_blank">Інструкції по встановленню (2)</a></li>
                        <li><a href="https://t.me/ddos_separ" target="_blank">Телеграм-канал</a></li>
                        <li><a href="https://github.com/Arriven/db1000n/releases/latest" target="_blank">Github releases</a></li>
                        <li><i class="bi bi-download"></i> <a href="/files/db1000n.exe" target="_blank">Пряме завантаження для Windows x64</a> (остання збережена версія)</li>
                    </ul>
                    </p>
                </li>
                <li>
                    <p>
                        <b>Програма UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
                    </p>
                    <p>
                        Описана в розділі "Дуже простий рівень", проте можна підвищити її ефективність, ввімкнувши VPN замість проксі. <b>Tor Browser тут використовувати не доцільно,</b> адже він працює тільки на сайтах з переліку вище (для програм не працює)!
                    </p>
                    <p>
                    <ul>
                        <li>
                            <a href="https://help-ukraine-win.com.ua/help-ukraine-win-en/2-vpn" target="_blank">Інструкції по встановленню з VPN</a>
                        </li>
                        <li>
                            <a href="https://help-ukraine-win.com.ua/639463cfe94541578431034bac9da90a" target="_blank">Як перейти із використання проксі на VPN?</a>
                        </li>
                        <li><a href="https://github.com/opengs/uashield/" target="_blank">Github</a></li>
                        <li><a href="https://gitlab.com/Hamsteroni/uashield" target="_blank">Gitlab</a></li>
                        <li><i class="bi bi-download"></i> <a href="/files/UA-Cyber-SHIELD-Setup.exe">Пряме завантаження для Windows</a> (остання збережена версія)</li>
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
                    Для найбільш ефективних атак через програми та скрипти й задля координування атак дивися документ: <a href="https://t.me/ddos_for_all/35" target="_blank">Telegram-повідомлення</a> <em>(починаючи з 9 сторінки)</em>.<br />
                    <span class="text-muted">Якщо телеграм-група недоступна: <a href="/files/DDOS_Tutorial_for_all.pdf" target="_blank">остання збережена версія тут</a></span>
                </li>
                <li>
                    Python-розробникам та всім, хто може запустити Python-скрипт:
                    просте та досить конфігураційне рішення: <a href="https://gist.github.com/NewEXE/a284a7ca0c3a2ddd2894907bb1787c63" target="_blank">gist.github.com</a>.
                    Потрібен Docker та Python 2.7 або 3.
                </li>
                <li>
                    <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua/3" target="_blank">Детально про реєстрацію на Microsoft Azure</a>. Також на сайті обширне FAQ.
                </li>
                <li>
                    <a href="https://telegra.ph/Kak-zapustit-MHDDoS-v-Google-Cloud-Shell-03-20" target="_blank">Як запустити MHDDoS у Google Cloud Shell</a> (рос мовою)
                </li>
                <li>
                    <a href="https://telegra.ph/Vstanovlennya-mhddos-proxy-napryamu-na-vash-komp-03-27" target="_blank">Встановлення mhddos_proxy напряму на ваш комп</a>
                </li>
                <li>
                    <a href="https://github.com/porthole-ascend-cinnamon/mhddos_proxy" target="_blank">Скрипт-обгортка для запуску потужного DDoS інструмента MHDDoS</a>
                </li>
                <li>
                    <a href="https://github.com/palahsu/DDoS-Ripper" target="_blank">DDoS-Ripper</a>
                </li>
                <li>
                    Інші способи атаки: <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua" target="_blank">тут</a> та <a href="https://github.com/SlavaUkraineSince1991/DDoS-for-all" target="_blank">тут</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
