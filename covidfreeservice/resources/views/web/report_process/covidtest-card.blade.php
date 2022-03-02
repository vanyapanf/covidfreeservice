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
        <a class="btn btn-primary" href="{{ route('accept_report', ['report_id' => $report->id]) }}">Подтвердить</a>
        <span class="btn btn-primary">Отклонить</span>
        <form class="cancel-report card" method="post" action="{{ route('cancel_report', ['report_id' => $report->id]) }}">
            <label class="col-form-label">Причина отмены заявки</label>
            <input class="cancel-reason__input">
            <button class="cancel-report__btn btn btn-primary" type="submit">Отклонить</button>
        </form>
    </p>
</div>
