@extends('web.layout')@section('main')
<div class="statistic-chart card">
    <h3 class="title">Статистика заболевания</h3>
    <div class="statistic-chart__container">
        <canvas id="covidStatChart"></canvas>
    </div>
</div>
<form class="create-post card" method="post" action="{{ route('new_post') }}" enctype="multipart/form-data">
    @csrf
    <h3 class="title">Запостить пост</h3>
    <input class="create-post__title" name="title" placeholder="Заголовок поста">
    <textarea class="create-post__textarea" name="post_text" placeholder="Напишите что-нибудь"></textarea>
    <span class="create-post__image">
        <label class="upload-photo__label" for="upload-photo">Загрузить изображение  <i class="fa fa-solid fa-image lg"></i></label>
        <input id="upload-photo" name="image" type="file">
    </span>
    <button class="create-post__btn btn btn-primary" type="submit">Запостить</button>
</form>
<form class="add-admin card" method="post" action="{{ route('add_admin') }}">
    @csrf
    <h3 class="title">Добавить/удалить админа</h3>
    <input class="add-admin__input" name="email" placeholder="Email пользователя">
    <div class="add-admin__actions">
        <button class="add-admin__btn btn btn-primary" name="action" value="Add" type="submit">Добавить</button>
        <button class="add-admin__btn btn btn-primary" name="action" value="Delete" type="submit">Удалить</button>
    </div>
</form>
<div class="process-reports card">
    <h3 class="title">Поддержка пользователей</h3>
    <a class="process-reports__btn btn btn-primary" href="{{ route('report_process') }}">Открыть</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script>
    var covidStatCanvas = document.getElementById('covidStatChart').getContext('2d');

    var myChart = new Chart(covidStatCanvas, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Заболевшие',
                    data: {!! $chart_illness_data !!},
                    borderColor: '#f08080',
                    backgroundColor: 'transparent',
                    tension: 0.5
                },
                {
                    label: 'Выздоровевшие',
                    data: {!! $chart_recovery_data !!},
                    borderColor: '#1e90ff',
                    backgroundColor: 'transparent',
                    tension: 0.5
                }
            ]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                point:{
                    radius: 0
                }
            }
        }
    });
</script>
@endsection
