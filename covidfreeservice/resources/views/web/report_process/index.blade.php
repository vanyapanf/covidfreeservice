@extends('web.layout')@section('main')
<div class="covidtests card">
    <h3 class="title">Тесты заболевание и выздоровление</h3>
    @foreach($active_reports as $report)
        @include('covidtest-card', $report)
    @endforeach
</div>
<div class="cancelled-tests card">
    <h3 class="title"></h3>
    @foreach($canceled_reports as $report)
        @include('', $report)
    @endforeach
</div>
@endsection
