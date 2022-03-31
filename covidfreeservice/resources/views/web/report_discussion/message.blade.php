<div class="user-status__message">
    <span class="message_username-and-date">{{ $message->user()->first()->name }} {{ $message->user()->first()->surname }} . {{ $message->dateAsCarbon->diffForHumans() }}.</span>
    <p class="message__text">{{ $message->message_text }}</p>
</div>
