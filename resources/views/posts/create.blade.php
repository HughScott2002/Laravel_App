@extends('layouts.app')

@section('title', 'New Blog')

@section('header', 'Create Blog')


@section('content')

    <form class='p-4 p-lg-5 p-md-4 p-sm-4'action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('posts.partials.form')
    </form>

@endsection()
