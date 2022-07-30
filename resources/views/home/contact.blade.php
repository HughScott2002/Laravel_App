@extends('layouts.app')

@section('title', 'Contact')

@section('header', 'Contact')


@section('content')
    <h2>Contact</h2>
    <h3>Contact Us</h3>
    @can('home.secret')
        <p>This is a secret</p>
        <a class='btn btn-danger'href="{{ route('secret') }}"> Press me</a>
    @endcan
@endsection()

@section('footer')
    @include('posts.partials._footer')
@endsection()
