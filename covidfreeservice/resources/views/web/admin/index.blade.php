@extends('web.layout')@section('main')
<div class="statistic-chart card">
    <h3 class="title">Статистика заболевания</h3>
    <div class="statistic-chart__container">
        <meta name="" content="">
        <canvas id="covidStatChart"></canvas>
    </div>
</div>
<div class="process-reports card">
    <a href="{{ route('report_process') }}">Работа с заявками о заболевании/выздоровлении</a>
</div>
<form class="create-post card" method="post" action="{{ route('new_post') }}">
    @csrf
    <h3 class="title">Запостить пост</h3>
    <textarea class="create-post__textarea" rows="10" cols="33" name="post"></textarea>
    <p>
        <button class="create-post__btn btn btn-primary" type="submit">Запостить</button>
        <!--<span class="create-post__image"><i class="fas fa-camera lg"></i></span>
        <span class="create-post__doc"><i class="fas fa-file-upload"></i></span>-->
    </p>
</form>
<form class="add-admin card" method="post" action="{{ route('add_admin') }}">
    @csrf
    <h3 class="title">Добавить админа</h3>
    <label class="col-form-label">Имя пользователя</label>
    <input class="add-admin__input">
    <button class="add-admin__btn btn btn-primary" type="submit">Добавить</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
@endsection
