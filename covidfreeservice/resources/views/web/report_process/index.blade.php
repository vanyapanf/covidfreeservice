@extends('web.layout')@section('main')
{{-- <div class="covidtests card">
    <h3 class="title">Тесты заболевание и выздоровление</h3>
    @foreach($active_reports as $report)
        @include('covidtest-card', $report)
    @endforeach
</div> --}}
<div class="cancelled-tests card">
    <h3 class="title">Поддержка пользователей с непрошедшими автоматическую проверку тестами</h3>
    @foreach($canceled_reports as $report)
        @include('web.report_process.cancel-card', $report)
    @endforeach
</div>
@endsection
