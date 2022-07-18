@extends('layouts.app')

@section('title', 'Edit')

@section('header', 'Edit')


@section('content')
    {{-- PATCH REQUEST --}}
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('posts.partials.form')

    </form>

@endsection()
