@extends('layouts.app')

@section('title', 'Posts')

@section('header', 'Posts')


@section('content')
    @forelse ($posts as $key => $post)
        <div class="p-4 p-lg-5 p-md-4 p-sm-4">
            @include('posts.partials.post')
        </div>
    @empty
        <div class="alert alert-info">
            No Post found!
        </div>
    @endforelse


    {{-- @if (count($posts))
        @foreach ($posts as $key => $post)
            @include('posts.partials.post')
            //<div>{{ $key + 1 }}. {{ $post['title'] }}</div>
        @endforeach
    @else
        NO Posts Found!
    @endif --}}


@endsection()
