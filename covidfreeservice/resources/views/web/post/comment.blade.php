<div class="post-card__comment">
    <span class="comment__username-and-date">{{ $comment->user()->first()->name }} {{ $comment->user()->first()->surname }} . {{ $comment->dateAsCarbon->diffForHumans() }}.</span>
    <p class="comment__text">{{ $comment->comment_text }}</p>
</div>
