@extends('layouts.app')

@section('content')
    <h4>Що робити у разі зникнення мобільного зв'язку або інтернету</h4>
    <p>
        Можна під'єднатися до мережі іншого оператора
        (тобто якщо у тебе умовний МТС, то можна обрати Київстар або life).
    </p>
    <p>
        Джерело інформації: <a href="https://t.me/objectivetv/11206" target="_blank">https://t.me/objectivetv/11206</a>.
        Уважно прочитайте інформацію з джерела також.
    </p>
    <p>
        Як це зробити, покроково:
    </p>
    <h5>Android</h5>
    <p>
        Дивіться інструкцію в картинках:
        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAndroidSettings"
                aria-expanded="false" aria-controls="collapseAndroidSettings"
        >
            Показати інструкцію
        </button>
        <div class="collapse" id="collapseAndroidSettings">
            <div class="card card-body">
                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/1.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Зайти в "Налаштування"</h5>
                                <p class="card-text">("Настройки")</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/2.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Wi-Fi та мережі</h5>
                                <p class="card-text">(Wi-Fi и сеть).</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/3.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">SIM-карта та мережа</h5>
                                <p class="card-text">(SIM-карта и сеть)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/4.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Обери сім-карту, мережа якої не працює.</h5>
                                <p class="card-text">Якщо у тебе одна сім-карта, то цього меню може не бути.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/5.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Оператори мережі</h5>
                                <p class="card-text">(Сетевые операторы)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/6.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Відключити автоматичний пошук мережі</h5>
                                <p class="card-text">(якщо було ввімкнуто)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/7.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Чекаємо</h5>
                                <p class="card-text">доки відбувається пошук доступних мереж</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/8.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Обрати іншого оператора</h5>
                                <p class="card-text">
                                    (для початку спробуйте 2G-мережу, з'явиться хоча б можливість дзвонити та повільний інтернет).
                                    Навіть якщо написано "Заборонено", підключитися можна!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/files/network/change-operator/9.jpeg" class="img-fluid rounded-start" alt="screenshot">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Якщо зв'язок не з'явився, спробуй іншого оператора чи ввімкни роумінг</h5>
                                <p class="card-text">(у мене запрацювало в роумінгу)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </p>

    <p>Або читайте нижче:</p>
    <ol>
        <li>Зайти в "Налаштування" ("Настройки")</li>
        <li>Wi-Fi та мережі (Wi-Fi и сеть)</li>
        <li>Обери сім-карту, мережа якої не працює</li>
        <li>Оператори мережі (сетевые операторы)</li>
        <li>Відключити автоматичний пошук мережі (якщо було ввімкнуто)</li>
        <li>
            Обрати іншого оператора
            (для початку спробуйте 2G-мережу, з'явиться хоча б можливість дзвонити та повільний інтернет).
            Навіть якщо написано "Заборонено", підключитися можна!
        </li>
        <li>
            Якщо зв'язок не з'явився, спробуй іншого оператора чи ввімкни роумінг (у мене запрацювало в роумінгу)
        </li>
    </ol>
    <p>
        На різних смартфонах по-різному, проте принцип схожий.
    </p>
    <h5>iOS (iPhone)</h5>
    <p>
        На iOS: Параметри – Стільникові дані – Вибір мережі.
    </p>
    <h4>Де дивитися український ефір, слухати радіо та читати новини</h4>
    <p>Що робити, якщо немає українського ефірного мовлення:</p>
    <p>
        <i class="bi bi-youtube"></i> Провідні канали України об'єдналися та ведуть єдиний цілодобовий інформаційний марафон (#UAразом).
        Прямий ефір можна дивитися на Youtube (обирай будь-який):
        <ul>
            <li><a href="https://www.youtube.com/watch?v=CwQl49tDPTk" target="_blank">Телеканал Рада. Прямий ефір</a></li>
            <li><a href="https://www.youtube.com/watch?v=lhs2JS_f9bI" target="_blank">Телеканал 1+1 онлайн. Спільний телемарафон #UAразом</a></li>
            <li><a href="https://www.youtube.com/watch?v=A-6hKtEp99c" target="_blank">Росія напала на Україну / Факти ICTV онлайн / Новини України зараз / Обстріли України</a></li>
            <li><a href="https://www.youtube.com/watch?v=IgSn1Z2rq6E" target="_blank">Україна 24 онлайн / Украина 24 онлайн. Прямий ефір</a></li>
            <li><a href="https://www.youtube.com/watch?v=ATjlRUA3tsY" target="_blank">Новости Украины на русском языке в прямом эфире - Марафон #UA_вместе</a> (поширюйте родичам та друзям з Росії)</li>
        </ul>
    </p>
    <p>Інші джерела та регіональні новини:</p>
    <ul>
        <li>
            <a href="https://viyna.net/9ac9be3cc98f4ec78e00b7a7efd556b9" target="_blank">Більше варіантів (інші мови, формати)</a>
        </li>
        <li>
            <a href="https://viyna.net/66823f92dccd4da0aaa492e78669da4e" target="_blank">Новини по містах та областях</a>
        </li>
    </ul>
    <p><i class="bi bi-telegram"></i> Різноманітні Telegram-канали:</p>
    <ul>
        <li><a href="https://t.me/suspilnenews" target="_blank">СУСПІЛЬНЕ НОВИНИ</a></li>
        <li><a href="https://t.me/objectivetv" target="_blank">Объектив - новости</a></li>
        <li><a href="https://t.me/verkhovna_rada_ua_zmi" target="_blank">Верховна Рада ЗМІ</a></li>
        <li><a href="https://t.me/myalgorhythm" target="_blank">Алгоритм | Україна переможе 🇺🇦</a></li>
        <li><a href="https://t.me/ssternenko" target="_blank">STERNENKO</a> (війсковий)</li>
        <li><a href="https://t.me/afi_12" target="_blank">Арія механічного соловейка</a> (волонтерка)</li>
    </ul>
    <p>Інформація нижче з Держспецзв'язку: <a href="https://t.me/verkhovnaradaukrainy/12772" target="_blank">джерело</a> (Telegram)</p>
    <p>
        💻📱 Якщо не працює українське ефірне телебачення, слідкувати за новинами можна на Youtube,
        в <a href="https://diia.gov.ua/" target="_blank">Дії</a>
        та ОТТ-платформах -
        <a href="https://youtv.ua/" target="_blank">YouTV</a>,
        <a href="https://sweet.tv/ru" target="_blank">Sweet TV</a>,
        <a href="https://omegatv.ua/" target="_blank">Omega TV</a>,
        <a href="https://megogo.net/" target="_blank">MEGOGO</a>,
        <a href="https://tv.kyivstar.ua/" target="_blank">Kyivstar TV</a>,
        <a href="https://oll.tv/" target="_blank">Oll tv</a>.
        В Дії та в безкоштовному інтернет-приймачі <a href="https://radioplayer.ua/" target="_blank">radioplayer.ua</a> мовить українське радіо.
        <a href="https://viyna.net/4679d44cb6b74bd3bc742af7a8cfb61b" target="_blank">Завантажити ці програми до смартфону</a>.
    </p>
    <p>
        📡 Якщо доступу до інтернету немає, дивитись телебачення безкоштовно можна на супутнику, адже сигнал було розкодовано в перші дні війни.
        Для цього достатньо супутникової антени та супутникового ресивера.
    </p>
    <p>
        📻 Ті, у кого немає ані обладнання для отримання сигналу з супутника, ані інтернету, все одно можуть слухати українське радіо.
        Для цього достатньо старих приймачів, які працюють на середніх хвилях. Ловіть сигнал у 1278, 1404, 873 та 657 кГц.
    </p>
@endsection
