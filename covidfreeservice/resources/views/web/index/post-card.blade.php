<div class="post-card card p-2">
    <div class="post-card__body">
        <span class="post-card__author-and-date">{{ $post->user()->first()->name }} {{ $post->user()->first()->surname }} . {{ $post->dateAsCarbon->diffForHumans() }}.</span>
        @if ($post->title)
            <h4 class="post-card__title">{{ $post->title }}</h4>
        @endif
        @if ($post->post_text)
            <p class="post-card__text">{{ $post->post_text }}</p>
        @endif
        @if ($post->path_to_img)
            <p class="post-card__img"><img src="{{ Storage::url($post->path_to_img) }}" class="card-img-top" alt=""></p>
        @endif
        <a class="post-card__comments-title" href="{{ route('post', ['post_id' => $post->id]) }}"><i class="far fa-comment"></i> {{ $comments_count[$post->id] }} комментарев</a>
    </div>
</div>
