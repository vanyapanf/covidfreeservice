@extends('web.layout')@section('main')
<div class="user-greeting card">
    <div class="title">
        <h3>Привет, <span class="username">{{ Auth::user()->name }}</span> 👋</h3>
    </div>
</div>
<div class="user-profile card">
    <h3 class="title">Профиль {{ Auth::user()->name }}</h3>
    <a class="process-reports__btn btn btn-primary" href="{{ route('profile') }}">Редактировать</a>
</div>
@if (!isset($last_report) || (Auth::user()->status === 'healthy' && $last_report->type === 'recovery' && $last_report->status === 'accept'))
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Вы здоровы &#128512;</p>
    </div>
@elseif (Auth::user()->status === 'healthy' && $last_report->type === 'illness' && $last_report->status === 'unconfirmed_report')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Ожидается подтверждающий тест/справка о заболевании 📄</p>
    </div>
@elseif (Auth::user()->status === 'illness' && $last_report->type === 'recovery' && $last_report->status === 'unconfirmed_report')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Ожидается подтверждающий тест/справка о выздоровлении 📄</p>
    </div>
@elseif (Auth::user()->status === 'healthy' && $last_report->type === 'illness' && $last_report->status === 'report_in_progress')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Подтверждение заболевания проверяется &#128076;</p>
    </div>
@elseif (Auth::user()->status === 'illness' && $last_report->type === 'recovery' && $last_report->status === 'report_in_progress')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Подтверждение выздоровления проверяется &#128076;</p>
    </div>
@elseif ($last_report->status === 'cancel_report' || $last_report->status === 'in_discussion')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Ваше подтверждение отклонено ¯\_(ツ)_/¯</p>
        <p class="user-status__reason">Причина: {{ $last_report->reason }}</p>
        <a class="user-status__messages-title" href="{{ route('report_discussion', ['report_id' => $last_report->id]) }}"><i class="far fa-comment"></i> Открыть сообщения</a>
    </div>
@elseif (Auth::user()->status === 'illness')
    <div class="user-status card">
        <div class="title">
            <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
        </div>
        <p class="user-status__text">Вы на карантине &#129298;</p>
    </div>
@endif
@if (isset(Auth::user()->tracker_id))
    <div class="tracker swiper card">
        <div class="title">
            <h3>Трекер здоровья</h3>
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide p-2">
                <form class="tracker__create" method="post" action="{{ route('create_trackercard') }}">
                    @csrf
                    <input class="tracker__temperature" name="temperature" type="text" placeholder="Ваша температура">
                    <br>
                    <span class="title">Ваше состояние:</span>
                    <br>
                    <input type="radio" id="healthChoice1" class="tracker__health" name="health_rate" value=1 checked>
                    <label for="healthChoice1">Плохо 1/5</label>
                    <input type="radio" id="healthChoice2" class="tracker__health" name="health_rate" value=2>
                    <label for="healthChoice2">Хуже 2/5</label>
                    <input type="radio" id="healthChoice3" class="tracker__health" name="health_rate" value=3>
                    <label for="helathChoice3">Средне 3/5</label>
                    <input type="radio" id="healthChoice4" class="tracker__health" name="health_rate" value=4>
                    <label for="helathChoice3">Лучше 4/5</label>
                    <input type="radio" id="healthChoice5" class="tracker__health" name="health_rate" value=5>
                    <label for="helathChoice3">Ок 5/5</label>
                    <br>
                    <button class="tracker__btn btn btn-primary" type="submit">Добавить</button>
                </form>
            </div>
            @foreach ($tracker_cards as $tracker_card)
                @include('web.user.tracker-card', ['tracker_card' => $tracker_card])
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
@endif
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".tracker", {
        initialSlide: 1,
        pagination: {
            el: ".swiper-pagination",
        }
    });
</script>
{{--<script type="text/javascript" src="{{ asset('js/user.js') }}"></script>--}}
@endsection
