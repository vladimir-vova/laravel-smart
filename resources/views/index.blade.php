@extends('layouts.layout')

@section('content')
<header class="container-fluid header">
    <div class="header_name">
        <h2>Создаём сайты, решающие бизнес задачи</h2>
        <br>
        <p>Делаем корпоративные сайты, магазины, проекты с нестандартным функционалом,<br> промо страницы. Найдем <span>решение</span> конкретно под <span>Ваш проект и бюджет</span>.</p>
    </div>
</header>
<div>
    <!-- COMMAND -->
    <div class="command container">
        <div class="command_left">
            Мы команда дизайнеров и разработчиков. Cоздаём веб сайты любой сложности.
        </div>
        <div class="command_right">
            Предлагаем решения Ваших задач в дизайне и в программировании. Вы ставите задачу — мы её решаем. Не будем лишний раз Вас беспокоить и отрывать от дел.
        </div>
    </div>
    <div id="obzor"></div>
    <!-- Процесс работы -->
    <div class="partt container">
        <div class="part_names">
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
    <div class="partt container">
        <div class="part_names">
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
                <a href="{{ route('remont') }}" title='ООО "Сити ремонт"' target="__blank"><img style="height: 550px;" src="{{ asset('assets/websites/remont/img/kosmet.jpg') }}" alt='ООО "Сити ремонт"'></a>
            </div>
        </div>
    </div>
    <div id="otzuv"></div>
    <!-- Отзывы -->
    <div class="partt container">
        <div class="part_names">
            <h2>Несколько отзывов о нашей работе</h2>
        </div>
        <div class="otz otzz1">
            <div class="otz1 otzs">
                <h4>Кузьмина А.А.</h4>
                <p>Давно хотел заказать сайт и тут подвернулось предложение с экспресс-дизайном без правок… для меня подошло идеально! Все работа выполнена в сроки, команда в чате спрашивала обо всех пожеланиях, присылали референсы.</p>
            </div>
            <div class="otz2 otzs">
                <h4>Петров В.А.</h4>
                <p>Заказал лендинг. Был очень требователен и придирчив в процессе. Большинство других агентств или фрилансеров давно бы послали с такой дотошностью, но не эти ребята. Отнеслись с пониманием и были очень вовлечены в работу, смело предлагали решения по анимации и расположению элементов, заморачивались с вёрсткой до мельчайших деталей!</p>
            </div>
            <div class="otz3 otzs">
                <h4>Власов Г.В.</h4>
                <p>Огромное спасибо. Сделали крутой сайт, именно такой какой и хотели под нашу концепцию!</p>
            </div>
        </div>
        <div class="otz otzz2">
            <div class="otz1 otzs">
                <h4>Федоров А.П</h4>
                <p>Разобрались в сложной технической теме и разработали классный прототип с грамотным текстом.</p>
                <p>А на дизайне только подтвердили свое мастерство, добавив элементы трехмерной графики и сделав стильный ретровейвный сайт!</p>
            </div>
            <div class="otz2 otzs">
                <h4>Славянов В.А.</h4>
                <p>Нам очень-очень-очень понравилось с вами работать. Делаете все действительно молниеносно, подтверждая свое название. А ещё понравилось, что вы советовали, как улучшить прототип.</p>
                <p>В итоге получилось то, что нужно! И здорово, что вы всегда быстро отвечаете на сообщения и обо всем напоминаете.</p>
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
    <div class="container-fluid price">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Давайте начнём</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="tn-span">+7 (999) 990 00-00</p>
                    <p class="tn-span">help@future.ru</p>
                </div>
                <div class="col-6" id="contact">
                    <!-- <form action="" method="POST">
                        <input type="text">
                    </form> -->
                    <form method="post" action="{{ route('contact') }}">
                        @csrf
                        <div class="mb-3">
                            <input name="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Ваше имя">
                        </div>
                        <div class="mb-3">
                            <input name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Ваш email">
                        </div>
                        <div class="mb-3">
                            <input name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" type="tel" placeholder="Ваш телефон" aria-describedby="telHelp" pattern="+7[0-9]{10}">
                            <div id="telHelp" class="form-text text-dark">
                                Формат: +79234567890
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer container">
        <div>&copy;2020-{{ date('Y') }}. Все права защищены. <a href="{{ route('login.create') }}">Авторизоваться</a></div>
        <div>Россия, г.Пермь</div>
    </div>
</div>

@endsection