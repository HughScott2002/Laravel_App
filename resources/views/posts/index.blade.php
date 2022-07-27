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
            <div class="d-flex flex-column">
                <div class="m-0">
                    <div class="card" style="width: 100%;">
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
                                <li class="list-group-item ">
                                    <a class="text-black text-decoration-none" href="/posts/{{ $most->id }}">
                                        {{ $most->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-4">

                    <div class="card" style="width: 100%;">
                        <img class='card-img-top'
                            src="https://i1.wp.com/networknuts.net/wp-content/uploads/2019/11/zahir-accounting-software-have-more-than-60.000-users.png"
                            alt="commments" />
                        <div class="card-body">
                            <h5 class="card-title text-center">Top Contributers</h5>
                            <p class="card-text mb-2 italic text-center">Users with the most posts contributed to
                                the
                                site</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            {{-- {{ dd($mostCommented) }} --}}
                            @foreach ($mostActive as $most)
                                <li class="list-group-item ">
                                    {{ $most->name }}{{ $most->is_admin ? ': Admin' : '' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-4">

                    <div class="card" style="width: 100%;">
                        <img class='card-img-top' src="https://producttribe.com/wp-content/uploads/2018/05/Img-4-2x-1.png"
                            alt="commments" />
                        <div class="card-body">
                            <h5 class="card-title text-center">Most Active Last Month</h5>
                            <p class="card-text mb-2 italic text-center">Users with the most written last mouth.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            {{-- {{ dd($mostCommented) }} --}}
                            @foreach ($mostActiveLastMonth as $most)
                                <li class="list-group-item ">
                                    {{ $most->name }}{{ $most->is_admin ? ': Admin' : '' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>

    </div>



@endsection()

@section('footer')
    @include('posts.partials.footer')
@endsection()
