@extends('layouts.app')

@section('title', $post->title)

@section('header', 'Post')


@section('content')

    <h2>{{ $post->title }}</h2>
    <h3>{{ $post->content }}</h3>
    <p>Added at {{ $post->created_at->diffForHumans() }}</p>

    @if (now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New post!</div>
    @endif
@endsection
