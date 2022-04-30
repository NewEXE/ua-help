@extends('layouts.app')

@section('content')
    <h5><b>🛡️ UA Cyber SHIELD</b> <span class="text-muted">за підтримки кабміну України</span></h5>
    <p>
        Все, що потрібно - просто завантажити програму та запустити її:
    </p>
    <p>
        <a class="btn btn-outline-success" href="https://github.com/opengs/uashield/releases/latest" target="_blank"><i class="bi bi-download"></i> Інструкції по встановленню</a>
    <ul>
        <li>
            Потрібна допомога чи інша версія? <a href="https://help-ukraine-win.com.ua/help-ukraine-win-ua/1" target="_blank">Докладна інструкція по встановленню</a>
        </li>
        <li>
            Канали розробників:
            <i class="bi bi-telegram"></i> <a href="https://t.me/uashield" target="_blank">Telegram</a>,
            <i class="bi bi-discord"></i> <a href="https://discord.gg/AHFYQmhgZa" target="_blank">Discord</a>,
            <i class="bi bi-at"></i> <a href="https://help-ukraine-win.com.ua/" target="_blank">офіційний сайт</a>
        </li>
    </ul>
    </p>
    <p class="lead">Як це працює?</p>
    <p>
        Атакує певний перелік сайтів із використанням проксі.
        Список сайтів та сама програма автоматично оновлюється.
    </p>
    <p class="lead"><b>Чи це безпечно?</b> Це не вірус?</p>
    <p>
    <ul>
        <li>
            Код програми публічно доступний на <a href="https://github.com/opengs/uashield" target="_blank">Github</a>
            та <a href="https://git.help-ukraine-win.com.ua/uashield/uashield" target="_blank">Gitlab</a>.
            <b>Будь-хто може подивитися, як вона працює</b>.
        </li>
        <li>
            На <a href="https://help-ukraine-win.com.ua/" target="_blank">офіційному сайті програми</a> заявлено, що вона розроблена <b>за підтримки кабміну України</b>.
        </li>
        <li>
            <a href="https://www.virustotal.com/gui/file/216e6ed8d01b71668c6ff56dbdaa2cfded1c38ce98f65f24cc899f1303a061a7?nocache=1" target="_blank">
                Результат перевірки програми антивірусами (версії для Windows)</a>
            (VirusTotal). <b>63 антивіруси не виявили злочинності</b>, тільки один російський антивірус (Kaspersky) визначив файл як шкідливий.
        </li>
        <li>
            Програма приховує IP-адресу користувача, тож <b>твоє місцеположення приховано</b>.
            Не вимикай перемикач "Атакувати тільки через проксі" або використовуй VPN, щоб твоя навіть приблизна локація була прихована від сайтів, на які йде атака.
        </li>
    </ul>
    <p class="lead">Чи можна атакувати ще ефективніше?</p>
    <p>
        Можна встановити VPN з російською країною, та вимкнути в програмі перемикач "Атакувати тільки через проксі".
        Тоді атака буде до 10 разів ефективнішою.
        Як налаштувати VPN, <a href="{{ route('pages.vpn') }}" target="_blank">дивися тут</a>.
        Також дивися більше способів на <a href="https://help-ukraine-win.com.ua/" target="_blank">офіційному сайті програми</a>
        та в нашому <a href="{{ route('pages.ddos') }}" target="_blank">розширенному гайду по DDoS</a>.
    </p>
    </p>

    <h5><b>🪡️ DB1000N</b> <span class="text-muted">Death by 1000 needles</span></h5>
    <p>
        В пару до попередньої програми я використовую ще цю - також достатньо просто завантажити та запустити:
    </p>
    <p>
        <a class="btn btn-outline-success" href="https://github.com/Arriven/db1000n/releases/latest" target="_blank"><i class="bi bi-download"></i> Інструкції по встановленню</a>
    <ul>
        <li>
            <b class="text-danger">Увага!</b>
            Якщо ти знаходишся в Україні, потрібно використовувати VPN для твоєї безпеки та більш ефективної атаки.
            В програмі для VPN необхідно час від часу змінювати локацію.
            Не використовуй українську локацію, атаки з українських місцерозташувань активніше блокуються.
            <a href="{{ route('pages.vpn') }}">Де знайти безкоштовний VPN, як встановити</a>.
        </li>
        <li>
            <b class="text-warning">Увага!</b>
            Програма не оновлюється самостійно, потрібно час від часу зупиняти її, завантажувати нову версію та запускати.
        </li>
        <li>
            Потрібна допомога чи інша версія? <a href="https://arriven.github.io/db1000n/uk/" target="_blank">Докладна інструкція по встановленню</a>
        </li>
        <li>
            Канали розробників:
            <i class="bi bi-at"></i> <a href="https://arriven.github.io/db1000n/uk" target="_blank">офіційний сайт</a>
        </li>
    </ul>
    </p>
    <p class="lead">Як це працює?</p>
    <p>
        Атакує певний перелік сайтів.
        Список сайтів автоматично оновлюється.
        Програму треба оновлювати самостійно (час від часу завантажувати знову та запускати).
    </p>
    <p class="lead"><b>Чи це безпечно?</b> Це не вірус?</p>
    <p>
        <ul>
            <li>
                Код програми публічно доступний на <a href="https://github.com/Arriven/db1000n" target="_blank">Github</a>
                та <a href="https://gitlab.com/db1000n/db1000n" target="_blank">Gitlab</a>.
                <b>Будь-хто може подивитися, як вона працює</b>.
            </li>
            <li>
                Програма рекомендована до використання спільнотою
                <i class="bi bi-telegram"></i> <a href="https://t.me/itarmyofukraine2022/229" target="_blank">IT ARMY of Ukraine</a>
                - найбільшою спільнотою кібер-армії.
            </li>
            <li>
                <a href="https://www.virustotal.com/gui/file/ebd908e371e1bbacc6c7e1461dad3e18f063ade8a1fd1e46fe331050a283fa1e?nocache=1" target="_blank">
                    Результат перевірки програми антивірусами (версії для Windows)</a>
                (VirusTotal). <b>65 антивірусів не виявили злочинності</b>, 4 визначили файл як шкідливий,
                проте 2 з них урахували злочинним сам те, що це програма для DDoS-атак (вона себе так і позиціонує).
                Тож ми маємо 2 антивіруси з 69, котрі рахують програму злочинною.
                В купі з тим, що весь код програми публічно відкритий (open-source), можна вважати ці прояви помилковими.
            </li>
        </ul>
    </p>
    <p class="lead">Більш складні рівні атаки (найвища ефективність): <a href="{{ route('pages.ddos') }}">Велика інструкція по DDoS</a></p>
@endsection
