<div class="user-status card">
    <div class="title">
        <h3>Cтатус <span class="username">{{ Auth::user()->name }}</span></h3>
    </div>
    <p class="user-status__text">Ваше подтверждение отклонено &#128076;</p>
    <div class="user-status__messages">
        @foreach ($messages as $message)
            @include('message', ['message' => $message])
        @endforeach
        <form class="user-status__create-message" method="post" action="{{ route('create_message', ['report_id' => $report['id']]) }}">
            <p>
                <input class="create-message__input" type="text" size="60" placeholder="Напишите что-нибудь">
                <button class="create-message__btn btn btn-primary" type="submit"><i class="far fa-paper-plane"></i></button>
            </p>
        </form>
    </div>
</div>
