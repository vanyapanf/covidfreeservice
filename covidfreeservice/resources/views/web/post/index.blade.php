@extends('web.layout')@section('main')
<div class="post-card__opened card p-2">
    <div class="post-card__body">
        <span class="post-card__author-and-date">{{ $post->user()->first()->name }} {{ $post->user()->first()->surname }} . {{ $post->dateAsCarbon->diffForHumans() }}.</span>
        @if ($post->title)
            <h4 class="post-card__text">{{ $post->title }}</h4>
        @endif
        @if ($post->post_text)
            <p class="post-card__text">{{ $post->post_text }}</p>
        @endif
        @if ($post->path_to_img)
            <p class="post-card__img"><img src="{{ Storage::url($post->path_to_img) }}" class="card-img-top" alt=""></p>
        @endif
    </div>
</div>
<div class="post-card__comments">
    @foreach ($comments as $comment)
        @include('web.post.comment', ['comment' => $comment])
    @endforeach
    <form action="{{ route('create_comment', ['post_id' => $post->id]) }}" method="post" class="post-card__create-comment">
        @csrf
        <input class="create-comment__input" name="comment" type="text" size="60" placeholder="Напишите что-нибудь">
        <button class="create-comment__btn btn btn-primary" type="submit"><i class="far fa-paper-plane"></i></button>
    </form>
</div>
@endsection
