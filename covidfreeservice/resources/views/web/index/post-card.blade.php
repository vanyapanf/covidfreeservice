<div class="post-card card p-2">
    <div class="post-card__body">
        <span class="post-card__tags-and-date">{{ $post->tag }} . {{ $post->dateAsCarbon->diffForHumans() }}.</span>
        <p class="post-card__text">{{ $post->post_text }}</p>
        <p class="post-card__img"><img src="https://pbs.twimg.com/media/Efdm5mMXkAMJqhl.jpg" class="card-img-top" alt=""></p>
        <a class="post-card__comments-title" href="{{ route('post', ['post_id' => $post->id]) }}"><i class="far fa-comment"></i> {{ $comments_count[$post->id] }} комментарев</a>
    </div>
</div>
