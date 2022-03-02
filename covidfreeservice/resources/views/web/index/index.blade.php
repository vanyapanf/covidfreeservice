@extends('web.layout')@section('main')
<div class="content-wrapper">
    <div class="content-wrapper-column">
        <div class="posts card">
            <div class="title">
                <h3>Оперативная информция</h3>
            </div>
            @foreach ($posts as $post)
                @include('web.index.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
    <div class="content-wrapper-column">
        <div class="covidMetrics card">
            <h3 class="title">Счетчик COVID</h3>
            <h3 class="counter">{{ $illnessesCount }}</h3>
            <h5>Заболели</h5>
            <h3 class="counter">{{ $recoveriesCount }}</h3>
            <h5>Выздоровели</h5>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
@endsection
