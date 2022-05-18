@extends('web.layout')@section('main')
<div class="content-wrapper-column">
    <form class="report-recovery card" method="post" action="{{ route('create_recoveryreport') }}">
        @csrf
        <div class="title">
            <h3>1. Сообщить о выздоровлении</h3>
        </div>
        <button class="report-recovery__btn btn btn-primary" name="action" value="Add" type="submit">Сообщить о выздоровлении</button>
        <button class="report-recovery__btn btn btn-danger" name="action" value="Cancel" type="submit">Отклонить заявку</button>
    </form>
    <div class="confirm-recovery card">
        <div class="title">
            <h3>2. Подтвердить выздоровлевание</h3>
        </div>
        <form class="confirm-recovery__load-form" method="post" action="{{ route('confirm_recoveryreport') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="doc">
            <button class="confirm-recovery__btn btn btn-primary elem-inline" type="submit">
                Отправить
            </button>
        </form>
    </div>
</div>
@endsection
