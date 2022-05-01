@extends('layouts.app')

@section('content')
    <p>Как можно помочь Украине в войне? <b>Сделаем, чтобы важные для ведения войны сайты не работали</b>:</p>
    <ul>
        <li>сайты пропаганды (gazeta.ru, ria.ru, smi2.ru, russian.rt.com и другие)</li>
        <li>сайт фюрера 21-го века (kremlin.ru)</li>
        <li>сайты военных структур (полиции, ФСБ и т.д.)</li>
        ...и другие, помогающие фюреру убивать украинцев.
        Перекройте информационный и денежный кран вашему президенту-диктатору.
    </ul>
    <p>
        Для этого не нужно быть IT-специалистом, достаточно "заходить" на эти сайты многократно (совершать на них запросы).
        Серверы сайтов не выдержат нагрузки и прекратят работу, особенно если ты присоединишься.
        Это называется <b>DDoS-атака</b>.
    </p>
    <p>Так <b>как я могу присоединиться к IT-армии?</b> Не переживай, тебе не придётся нажмимать на кнопку перезагрузки страницы миллион раз, достаточно:</p>
    <ul>
        <li>запустить специальную программу <span class="text-muted">или даже</span></li>
        <li>просто зайти на специализованный сайт</li>
    </ul>
    <p>Имея компьютер, ноутбук или смартфон, ты можешь <b>помочь</b>, не будучи опытным пользователем ПК, <b>без специальных навыков</b>.</p>
    <p>Что для этого нужно:</p>
    <ul>
        <li>устройство - компьютер, ноутбук или смартфон;</li>
        <li>интернет, желательно безлимитный и стабильный.</li>
    </ul>

    <h4>Очень простой уровень <em>(без VPN)</em></h4>

    <ol>
        <li>
            <p>
                <b>Программа UA Cyber SHIELD</b> ( <i class="bi bi-windows"></i> <i class="bi bi-apple"></i>🐧)
            </p>
            <p>
                Всё, что необходимо - просто скачать программу и запустить её (есть версии для Windows, Mac и Linux).
                Это можно сделать с официальных источников:
            </p>
            <p>
            <ul>
                <li><i class="bi bi-download"></i> <a href="/storage/software/UA-Cyber-SHIELD-Setup.exe">Установить для Windows</a> (последняя сохранённая версия)</li>
                <li><a target="_blank" href="https://help-ukraine-win.com.ua/help-ukraine-win-en/the-easiest">Инструкция пр установке</a></li>
                <li><a href="https://t.me/uashield" target="_blank">Telegram-канал</a></li>
                <li><a href="https://github.com/opengs/uashield/releases/latest" target="_blank">Github releases</a></li>
                <li><a href="https://gitlab.com/Hamsteroni/uashield" target="_blank">Gitlab</a></li>
            </ul>
            </p>
            <p>
                Как это работает?
                Атакует определённый список сайтов, который самостоятельно динамически изменяется, с использованием прокси, так что ты в безопасности - твои <b>IP-адрес и геолокациия скрыты</b>.
                <a href="https://github.com/opengs/uashield" target="_blank">This is open-source software</a>.
            </p>
        </li>
    </ol>

    <p>Это всё! Но для более эффективных атак используй простой и продвинутый уровни:</p>

    <div class="spoiler">
        <input type="checkbox" id="other-attack-levels">
        <label for="other-attack-levels">
            <h5>
                <i class="bi bi-caret-right-square"></i>
                <span class="link-primary text-decoration-underline">Открыть простой и продвинутый уровни - нажми сюда</span>
                <i class="bi bi-caret-left-square"></i>
            </h5>
        </label>
        <div>
            Для информации, где скачать VPN и более эффективные средства, смотри
            <a href="{{ route('locale.switch', ['locale' => 'en']) }}">английскую</a>
            либо
            <a href="{{ route('locale.switch', ['locale' => 'ua']) }}">украинскую</a>
            версию страницы.
        </div>
    </div>
@endsection
