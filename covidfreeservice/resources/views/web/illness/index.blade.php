@extends('web.layout')@section('main')
<div class="content-wrapper-column">
    <form class="report-illness card" method="post" action="{{ route('create_illnessreport') }}">
        @csrf
        <div class="title">
            <h3>1. Сообщить о заболевании</h3>
        </div>
        <button class="report-illness__btn btn btn-primary" name="action" value="Tracker" type="submit">Подключить трекер</button>
        <button class="report-illness__btn btn btn-primary" name="action" value="Add" type="submit">Сообщить о заболевании</button>
        <button class="report-illness__btn btn btn-danger" name="action" value="Cancel" type="submit">Отклонить заявку</button>
    </form>
    <div class="confirm-illness card">
        <div class="title">
            <h3>2. Подтвердить заболевание</h3>
        </div>
        <form class="confirm-illness__load-form" method="post" action="{{ route('confirm_illnessreport') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="doc">
            <button class="confirm-illness__btn btn btn-primary elem-inline" type="submit">
                Отправить
            </button>
        </form>
    </div>
</div>
@endsection
