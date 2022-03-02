@extends('web.layout')@section('main')
<div class="content-wrapper">
    <div class="content-wrapper-column">
        <form class="report-illness card" method="post" action="{{ route('create_illnessreport') }}">
            @csrf
            <div class="title">
                <h3>Сообщить о заболевании</h3>
            </div>
           <!-- <div class="report-illness__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Имя*</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div>
            <div class="report-illness__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Фамилия*</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div>
            <span class="report-illness__help">* - обязательные поля</span>
            <div class="report-illness__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Группа</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div> -->
            <button class="report-illness__btn btn btn-primary" name="has_tracker">Подключить трекер</button>
            <button class="report-illness__btn btn btn-primary" type="submit">Сообщить о заболевании</button>
        </form>
        <div class="confirm-illness card">
            <div class="title">
                <h3>Подтвердить заболевание</h3>
            </div>
            <form class="confirm-illness__load-form" method="post" action="{{ route('confirm_illnessreport') }}">
                @csrf
                <div class="confirm-illness__btn btn btn-primary elem-inline">
                    <input type="file" name="doc">Загрузить тест или справку  <i class="fas fa-download"></i>
                </div>
                <button class="confirm-illness__btn btn btn-primary elem-inline" type="submit">
                    Отправить
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
