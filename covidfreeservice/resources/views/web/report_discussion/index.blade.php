@extends('web.layout')@section('main')
<div class="user-status card">
    <div class="title">
        <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
    </div>
    <p class="user-status__text">Ваше подтверждение отклонено ¯\_(ツ)_/¯</p>
    <p class="user-status__reason">Причина: {{ $report->reason }}</p>
</div>
<div class="user-status__messages">
    @foreach ($messages as $message)
        @include('web.report_discussion.message', ['message' => $message])
    @endforeach
    @if ($messages->isEmpty() || $report->status == 'in_discussion')
        <form class="user-status__create-message" method="post" action="{{ route('create_message', ['report_id' => $report['id']]) }}">
            @csrf
            <input class="create-message__input" name="message_text" type="text" size="60" placeholder="Напишите что-нибудь">
            <button class="create-message__btn btn btn-primary" type="submit"><i class="far fa-paper-plane"></i></button>
        </form>
    @else
        <div class="user-status__create-message">
            <span class="discussion-closed">Обсуждение закрыто</span>
        </div>
    @endif
</div>
<script>

</script>
{{--<script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>--}}
@endsection
