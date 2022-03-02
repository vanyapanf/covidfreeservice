<div class="post-card__comment">
    <span class="comment__username-and-date">{{ $comment->user_id }} . {{ $comment->dateAsCarbon->diffForHumans() }}.</span>
    <p class="comment__text">{{ $comment->comment_text }}</p>
</div>
