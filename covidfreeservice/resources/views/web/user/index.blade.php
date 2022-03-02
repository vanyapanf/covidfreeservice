@extends('web.layout')@section('main')
<div class="content-wrapper-column">
    <div class="user-greeting card">
        <div class="title">
            <h3>Привет, <span class="username">{{ Auth::user()->name }}</span> 👋</h3>
        </div>
    </div>
    @if (!isset($last_report) || ($user->status === 'healthy' && report->type === 'recovery' && $report->status === 'accept'))
        <div class="user-status card">
            <div class="title">
                <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
            </div>
            <p class="user-status__text">Вы здоровы &#128512;</p>
        </div>
    @elseif ($user->status === 'healthy' && $report->type === 'illness' && $report->status === 'report_in_progress')
        <div class="user-status card">
            <div class="title">
                <h3>Cтатус <span class="username">{{ $user->name }}</span></h3>
            </div>
            <p class="user-status__text">Подтверждение заболевания проверяется &#128076;</p>
        </div>
    @elseif ($user->status === 'illness' && $report->type === 'recovery' && $report->status === 'report_in_progress')
        <div class="user-status card">
            <div class="title">
                <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
            </div>
            <p class="user-status__text">Подтверждение выздоровления проверяется &#128076;</p>
        </div>
    @elseif ($report->status === 'cancel_report')
        <div class="user-status card">
            <div class="title">
                <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
            </div>
            <p class="user-status__text">Ваше подтверждение отклонено &#128076;</p>
            <a class="user-status__messages-title" href="{{ route('report_discussion', ['report_id' => $report->id]) }}"><i class="far fa-comment"></i> Открыть сообщения</a>
        </div>
    @elseif ($user->status === 'illness')
        <div class="user-status card">
            <div class="title">
                <h3>Cтатус <span class="username">{{ $user->name }}</span></h3>
            </div>
            <p class="user-status__text">Вы на карантине &#129298;</p>
        </div>
    @endif
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
                @include('tracker_card', ['tracker_card' => $tracker_card])
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
@endsection
