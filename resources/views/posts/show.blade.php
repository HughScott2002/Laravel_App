@extends('layouts.app')

@section('title', $post->title)

@section('header', 'Post')


@section('content')
    <div class="py-2 py-lg-4">
        <h2 class="p-md-4 py-4 px-2 text-center fs-2 fw-bolder fst-italic " style="background: rgb(215, 205, 192); ">
            {{ $post->title }}</h2>
        <div class="d-flex justify-content-end">
            <h3 class=" mt-2 text-muted fs-5 fw-light fst-italic">Author: Mary Jane</h3>
            <div class="mx-2 my-2 pb-2" style="height: 4rem; width: 4rem; ">
                <img class="hover rounded-circle img-fluid"
                    src="https://assets.papelpop.com/wp-content/uploads/2022/02/kirsten-dunst.png" alt="author image" />
            </div>

        </div>
        <p class="text-break word-break break-word word-wrap fs-3 p-md-3 px-2">{{ $post->content }}</p>
    </div>
    <div class="d-flex justify-content-end align-content-center p-2">
        <p>Added at {{ $post->created_at->diffForHumans() }}</p>
    </div>

    <div>
        <h4 class="text-center pb-4 fs-4 alert alert-info ">Commets</h4>
        @forelse ($post->comments as $comment)
            <div class="bg-light border p-3 mb-3">
                Created: {{ $comment->created_at->diffForHumans() }}
                {{ $comment->created_at > $comment->updated_at ? '(Ediited)' : '' }}
                <p class="py-2">{{ $comment->content }}</p>
            </div>

    </div>
@empty
    <div class="alert alert-danger">No Comments</div>
    @endforelse
    </div>
    @if (now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New post!</div>
    @endif
@endsection

@section('footer')
    @include('posts.partials.footer')
@endsection()
