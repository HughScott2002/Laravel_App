@extends('layouts.app')

@section('title', 'Posts')

@section('header', 'Posts')


@section('content')
    @forelse ($posts as $key => $post)
        <div class="p-4 p-lg-5 p-md-4 p-sm-4">
            @include('posts.partials.post')
        </div>
    @empty
        <div class="alert alert-info d-flex justify-content-center p-4 text-bold">
            No Post found!
        </div>
    @endforelse



@endsection()

@section('footer')
    @include('posts.partials.footer')
@endsection()
