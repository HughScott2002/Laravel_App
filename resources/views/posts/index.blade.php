@extends('layouts.app')

@section('title', 'Posts')

@section('header', 'Posts')


@section('content')
    <div class="row m-0">
        <div class="col-8">
            @forelse ($posts as $key => $post)
                <div class="p-4 p-lg-5 p-md-4 p-sm-4">
                    @include('posts.partials.post')

                </div>
            @empty
                <div class="alert alert-info d-flex justify-content-center p-4 text-bold">
                    No Post found!
                </div>
            @endforelse
        </div>

        <div class="col-4">
            <div class="card" style="width: 25rem;">
                <img class='card-img-top'
                    src="https://www.blogtyrant.com/wp-content/uploads/2013/01/how-to-get-more-blog-comments.jpg"
                    alt="commments" />
                <div class="card-body">
                    <h5 class="card-title text-center">Most Commented</h5>
                    <p class="card-text mb-2 italic text-center">What people are talking about right</p>
                </div>
                <ul class="list-group list-group-flush">
                    {{-- {{ dd($mostCommented) }} --}}
                    @foreach ($mostCommented as $most)
                        <li class="list-group-item">{{ $most->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>



@endsection()

@section('footer')
    @include('posts.partials.footer')
@endsection()
