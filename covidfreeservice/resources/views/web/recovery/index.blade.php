@extends('web.layout')@section('main')
<div class="content-wrapper">
    <div class="content-wrapper-column">
        <form class="report-recovery card" method="post" action="{{ route('create_recoveryreport') }}">
            @csrf
            <div class="title">
                <h3>Сообщить о выздоровлении</h3>
            </div>
            <!--<div class="report-recovery__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Имя*</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div>
            <div class="report-recovery__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Фамилия*</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div>
            <span class="report-recovery__help">* - обязательные поля</span>
            <div class="report-recovery__input-line">
                <div class="col-auto">
                    <label class="col-form-label">Группа</label>
                </div>
                <div class="col-auto">
                    <input class="input-line__input form-control">
                </div>
            </div>-->
            <button class="report-recovery__btn btn btn-primary" type="submit">Сообщить о выздоровлении</button>
        </form>
        <div class="confirm-recovery card">
            <div class="title">
                <h3>Подтвердить выздоровлевание</h3>
            </div>
            <form class="confirm-recovery__load-form" method="post" action="{{ route('confirm_recoveryreport') }}">
                @csrf
                <div class="confirm-recovery__btn btn btn-primary elem-inline">
                    <input type="file" name="doc">Загрузить тест или справку  <i class="fas fa-download"></i>
                </div>
                <button class="confirm-recovery__btn btn btn-primary elem-inline" type="submit">
                    Отправить
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
