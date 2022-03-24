@extends('layouts.app')

@section('content')
    <p>
        В Украине сейчас идет война. Не спецоперация.
    </p>
    <p>
        Силами РФ наносятся удары по гражданской инфраструктуре в Харькове, Киеве, Чернигове, Сумах, Ирпене и десятках других городов.
        Гибнут люди - и гражданское население, и военные, в том числе российские призывники, которых бросили воевать.
    </p>
    <p>
        Чтобы лишить собственный народ доступа к информации, правительство РФ запретило называть войну войной, закрыло независимые СМИ и принимает сейчас ряд диктаторских законов.
        Эти законы призваны заткнуть рот всем, кто против войны.
        За обычный призыв к миру сейчас можно получить несколько лет тюрьмы.
    </p>
    <p><b>Не молчите! Молчание - знак вашего согласия с политикой российского правительства.</b></p>

    <h4><i class="bi bi-hash"></i> Информационная борьба</h4>
    <p>
        <i class="bi bi-server"></i> <a href="{{ route('pages.ddos') }}">Атака на пропагандистские сайты</a> (доступно каждому)
    </p>
    <h4><i class="bi bi-cash-coin"></i> Финансовая поддержка</h4>
    <p>
        <b>ВНИМАНИЕ!</b> Для граждан России поддержка Украины банковским переводом наказуема как государственная измена! Ваш фюрер запретил предотвращать убийства украинских детей. Используйте криптовалюту:
        <i class="bi bi-currency-bitcoin"></i> Bitcoin/Ethereum/другие: <a href="https://donate.thedigital.gov.ua/" target="_blank">donate.thedigital.gov.ua</a>
    </p>
@endsection
