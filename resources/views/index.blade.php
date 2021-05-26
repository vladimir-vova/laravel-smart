@extends('layouts.layout')

@section('content')
<header class="container-fluid header">
    <div class="header_name">
        <h2>Создаём сайты, решающие бизнес задачи</h2>
        <br>
        <p>Делаем корпоративные сайты, магазины, проекты с нестандартным функционалом,<br> промо страницы. Найдем <span>решение</span> конкретно под <span>Ваш проект и бюджет</span>.</p>
    </div>
</header>
<div class="container">
    <!-- COMMAND -->
    <div class="command">
        <div class="command_left">
            Мы команда дизайнеров и разработчиков. Cоздаём веб сайты любой сложности.
        </div>
        <div class="command_right">
            Предлагаем решения Ваших задач в дизайне и в программировании. Вы ставите задачу — мы её решаем. Не будем лишний раз Вас беспокоить и отрывать от дел.
        </div>
    </div>
    <div id="obzor"></div>
    <!-- Процесс работы -->
    <div class="partt">
        <div class="part_names">
            <h5>ПРОЦЕСС РАБОТЫ</h5>
            <h2>Как мы создаем проект</h2>
        </div>
        <div class="part_data">
            <div class="part">
                <div class="number">1</div>
                <div class="part_name">Аналитика</div>
                <div class="part_info">Анализ вашего бизнеса, ваших предпочтений</div>
            </div>
            <div class="part">
                <div class="number">2</div>
                <div class="part_name">Прототипирование</div>
                <div class="part_info">Разработка прототипа сайта для согласования с заказчиком</div>
            </div>
            <div class="part">
                <div class="number">3</div>
                <div class="part_name">Дизайн</div>
                <div class="part_info">Разработка дизайна сайта</div>
            </div>
            <div class="part">
                <div class="number">4</div>
                <div class="part_name">Программирование</div>
                <div class="part_info">Создание полноценного рабочего сайта</div>
            </div>
        </div>
    </div>
    <div id="osobennosti"></div>
    <!-- Кейсы -->
    <div class="partt">
        <div class="part_names">
            <h5>КЕЙСЫ</h5>
            <h2>Наши работы</h2>
        </div>
        <div class="row" style="text-align: center;">
            <div class="col-4">
                <p>МЦ "Здоровье"</p>
                <a href="{{ route('medic') }}" title='МЦ "Здоровье"' target="__blank"><img style="height: 550px;" src="{{ asset('assets/websites/medic/img/untitled-1.png') }}" alt='МЦ "Здоровье"'></a>
            </div>
            <div class="col-4">
                <p>ООО "Торты"</p>
                <a href="{{ route('tort') }}" title='ООО "Торты"' target="__blank"><img style="height: 550px;" src="{{ asset('assets/websites/tort/img/meets-pic.jpg') }}" alt='ООО "Торты"'></a>
            </div>
            <div class="col-4">
                <p>ООО "Сити ремонт"</p>
                <a href="{{ route('medic') }}" title='' target="__blank"><img style="height: 550px;" src="{{ asset('assets/websites/medic/img/untitled-1.png') }}" alt=""></a>
            </div>
        </div>
    </div>
    <div id="otzuv"></div>
    <!-- Отзывы -->
    <div class="partt">
        <div class="part_names">
            <h5>ОТЗЫВЫ</h5>
            <h2>Несколько отзывов о нашей работе</h2>
        </div>
        <div class="otz otzz1">
            <div class="otz1 otzs">
                <h4>Кузьмина А.А.</h4>
                <p>Благодарим за разработку сайта под ключ. Работа была выполнена с учётом всех наших пожеланий и в оговоренные сроки. Рекомендуем к сотрудничеству.</p>
            </div>
            <div class="otz2 otzs">
                <h4>Петров В.А.</h4>
                <p>Благодарим веб студию за разработку сайта и техническую поддержку.</p>
                <p>На протяжении всего проекта мы были удовлетворены работой веб-студии, весь цикл работ от согласования тех.задания до наполнения сайта был выполнен без нареканий.</p>
                <p>В процессе разработки сайта мы получали рекомендации, также были учтены наши пожелания, ошибки и неточности исправлялись оперативно.</p>
            </div>
            <div class="otz3 otzs">
                <h4>Власов Г.В.</h4>
                <p>Заказывали разработку интернет-магазина косметики на wordpress. Работа была выполнена очень качественно и в срок! Все пожелания учитывались, доработки в ходе выполнения проекта производились быстро! Илья вникал во все нюансы и вносил предложения по улучшению дизайна и функционала сайта. Очень довольны работой! В будущем будем обращаться только к нему. Спасибо!</p>
            </div>
        </div>
        <div class="otz otzz2">
            <div class="otz1 otzs">
                <h4>Федоров А.П</h4>
                <p>Благодарим студию за создание лендинга для нашей компании. Сайт хорошо конвертирует на Яндекс Директ и быстро загружается.</p>
                <p>Были учтены все наши хотелки, было разработано две версии дизайна на выбор и за это отдельное спасибо. Желаем процветания и успехов Вашей компании.</p>
            </div>
            <div class="otz2 otzs">
                <h4>Славянов В.А.</h4>
                <p>Выражаем благодарность веб-студии А4 за разработку сайта. В частности выполнен дизайн, верстка, установка на CMS, результатом довольны. </p>
                <p>Сайт работает без проблем. Очень удобный кабинет администратора для редактирования сайта.</p>
            </div>
            <div class="otz3 otzs">
                <h4>Васильев Г.В.</h4>
                <p>Благодарим за разработку сайта под ключ. Работа была выполнена с учётом всех наших пожеланий и в оговоренные сроки. Рекомендуем к сотрудничеству.</p>
            </div>
        </div>
        <div class="points">
            <div class="point point1 p1"></div>
            <div class="point p2"></div>
        </div>
    </div>
    <div id="download"></div>
    <!-- Стоимость -->
    <div class="price">
        <div class="part_names">
            <h5>СТОИМОСТЬ</h5>
            <div class="row">
                <div class="col-6 text-price">
                    <h2>Зарегистрируйтесь, чтoбы заказать услуги</h2>
                    <p>Koopдинaтop oтвeтит нa вce вaши вoпpocы пo услугам.</p>
                </div>
                <div class="col"></div>
                <div class="col-4 register text-start">
                    <!-- <a href="" class='btn btn-primary'>Зарегистрироваться</a> или
                        <br><br> -->
                    <a href="{{ route('orders.quit') }}" class='text-danger'>Сделать быстрый заказ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div>&copy;2020. Все права защищены. <a href="{{ route('login.create') }}">Авторизоваться</a></div>
        <div>Пермь, ул. Луначарского, д.6</div>
    </div>
</div>

@endsection