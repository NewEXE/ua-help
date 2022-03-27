@extends('layouts.app')

@section('content')
    <h4>Що робити у разі зникнення мобільного зв'язку або інтернету</h4>
    <p>
        Можна під'єднатися до мережі іншого оператора
        (тобто якщо у тебе умовний МТС, то можна обрати Київстар чи life).
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
    <h4>Де дивитися об'єднаний український ефір чи радіо</h4>
    <p>Що робити, якщо немає українського ефірного мовлення та доступу до інтернету</p>
    <p>
        💻📱 Якщо не працює українське ефірне телебачення, слідкувати за новинами можна на Youtube, в Дії та ОТТ-платформах - YouTV, Sweet TV, Omega TV, MEGOGO, Kyivstar TV, Oll tv.
        В Дії та в безкоштовному інтернет-приймачі radioplayer.ua мовить українське радіо.
        <a href="https://viyna.net/4679d44cb6b74bd3bc742af7a8cfb61b" target="_blank">Завантажити програми для ТВ до смартфону</a>
    </p>
    <p>
        Канали на Youtube:
        <ul>
            <li><a href="https://www.youtube.com/watch?v=CwQl49tDPTk">Рада онлайн</a></li>
            <li><a href="https://www.youtube.com/watch?v=A-6hKtEp99c">ICTV онлайн</a></li>
            <li><a href="https://www.youtube.com/watch?v=A-6hKtEp99c">ICTV онлайн</a></li>
        </ul>
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
