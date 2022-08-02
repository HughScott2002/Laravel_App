@extends('layouts.app')

@section('title', 'New Blog')

@section('header', 'Create Blog')


@section('content')

    <form enctype="multipart/form-data" class='p-4 p-lg-5 p-md-4 p-sm-4 needs-validation' action="{{ route('posts.store') }}"
        method="POST" novalidate>
        @csrf
        @include('posts.partials._form')
    </form>

@endsection()

@section('footer')
    @include('posts.partials._footer')
@endsection()
