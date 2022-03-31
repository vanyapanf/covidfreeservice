<div class="covidtests-card card">
    @if($report->type === 'illness')
        <h5 class="title">Заболевание</h5>
    @elseif($report->type === 'recovery')
        <h5 class="title">Выздоровление</h5>
    @endif
    <p class="card-text">{{ $report->user()->first()->name }} {{ $report->user()->first()->surname }} <br> {{ $report->user()->first()->study_group }}</p>
    <div class="card-buttons">
        <a class="card-button btn btn-primary" href="{{ Storage::url($report['path_to_doc']) }}" >
            Тест <i class="fas fa-file"></i>
        </a>
        <a class="card-button btn btn-primary" href="{{ route('close_discussion', ['report_id' => $report->id]) }}" >
            Закрыть обсуждение <i class="fas fa-times"></i>
        </a>
        <a class="card-button" href="{{ route('report_discussion', ['report_id' => $report->id]) }}">Открыть сообщения <i class="fas fa-comment"></i></a>
    </div>
</div>
