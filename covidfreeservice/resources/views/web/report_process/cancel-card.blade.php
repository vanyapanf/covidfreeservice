<div class="covidtests-card card">
    @if($report->type === 'illness')
        <h5 class="title">Заболевание</h5>
    @elseif($report->type === 'recovery')
        <h5 class="title">Выздоровление</h5>
    @endif
    <p class="card-text">{{ $report->user_id }} <br> {{  }}</p>
    <p>
        <a class="btn btn-primary" href="{{ route('report_doc', ['report_id' => $report->id]) }}" >
            Тест <i class="fas fa-file-download"></i>
        </a>
        <a class="covidtests-card__messages-title" href="{{ route('report_discussion', ['report_id' => $report->id]) }}"><i class="far fa-comment"></i> Открыть сообщения</a>
    </p>
</div>
