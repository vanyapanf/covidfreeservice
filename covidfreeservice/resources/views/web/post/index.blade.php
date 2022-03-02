@extends('web.layout')@section('main')
<div class="post-card card p-2">
    <div class="post-card__body">
        <span class="post-card__tags-and-date">{{ $post->tag }} . {{ $post->dateAsCarbon->diffForHumans() }}.</span>
        <p class="post-card__text">{{ $post->post_text }}</p>
        <p class="post-card__img"><img src="https://pbs.twimg.com/media/Efdm5mMXkAMJqhl.jpg" class="card-img-top" alt=""></p>
        <span class="post-card__comments-title"><i class="far fa-comment"></i> {{ $comments->count() }} комментарев</span>
        <div class="post-card__comments">
            @foreach ($comments as $comment)
                @include('web.post.comment', ['comment' => $comment])
            @endforeach
            <form action="{{ route('create_comment', ['post_id' => $post->id]) }}" method="post" class="post-card__create-comment">
                @csrf
                <p>
                    <input class="create-comment__input" name="comment" type="text" size="60" placeholder="Напишите что-нибудь">
                    <button class="create-comment__btn btn btn-primary" type="submit"><i class="far fa-paper-plane"></i></button>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
