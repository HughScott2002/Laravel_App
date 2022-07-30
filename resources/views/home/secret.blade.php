@extends('layouts.app')

@section('title', 'Contact-Secret')

@section('header', 'Secret')


@section('content')
    <h1 class="text-center p-4">This is a secret</h1>
    <p>Behold my secret and more welps</p>
@endsection()

@section('footer')
    @include('posts.partials._footer')
@endsection()
