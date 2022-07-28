@extends('layouts.app')

@section('title', $post->title)

@section('header', 'Post')


@section('content')
    <div class="py-2 py-lg-4">
        <h2 class="p-md-4 py-4 px-2 text-center fs-2 fw-bolder fst-italic " style="background: rgb(215, 205, 192); ">
            {{ $post->title }}</h2>
        {{-- <div class="d-flex justify-content-end">
            <h3 class=" mt-2 text-muted fs-5 fw-light fst-italic">Author: Mary Jane</h3>
            <div class="mx-2 my-2 pb-2" style="height: 4rem; width: 4rem; ">
                <img class="hover rounded-circle img-fluid"
                    src="https://assets.papelpop.com/wp-content/uploads/2022/02/kirsten-dunst.png" alt="author image" />
            </div>

        </div> --}}
        <div class="d-flex justify-content-end">
            <h3 class=" mt-2 text-muted fs-5 fw-light fst-italic">Author: {{ $post->user->name }}</h3>
        </div>

        <div class="">
            <p class="fst-italic fs-5 bg-info py-2 bg-opacity-25 px-3">Being read by:
                {{ $counter > 1 ? "{$counter} persons" : '0' }}</p>
        </div>
        <div>
            <p class="text-break word-break break-word word-wrap fs-3 p-md-3 px-2">{{ $post->content }}</p>
        </div>
    </div>
    <div class="d-flex justify-content-end align-content-center p-2">
        <p>Added at {{ $post->created_at->diffForHumans() }}</p>
    </div>

    <div>
        <h4 class=" pb-4 fs-4 alert alert-info text-center">Comments</h4>
        <form action="{{ route('comments.store') }} " method="POST">
            @csrf
            <div class="form-floating mb-3">
                <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2"> Add Comment</label>
            </div>
            <input type="text" name="blog_post_id" value="{{ $post->id }}" hidden />

            <div class="my-4">
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>

        </form>

        @forelse ($post->comments as $comment)
            <div class="bg-light border p-3 mb-3">
                <div>
                    Created:
                    {{ $comment->created_at->diffForHumans() }}{{ $comment->created_at > $comment->updated_at ? '(Ediited)' : '' }}
                    @if ($comment->trashed())
                        <span>
                            Trashed
                        </span>
                    @endif
                </div>
                {{-- <div>
                    Username: {{ $post->user->name }}

                </div> --}}
                <p class="py-2">{{ $comment->content }}</p>

                @if (!$comment->trashed())
                    <form action="{{ route('comments.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="text" name='comment_id' value='{{ $comment->id }}' hidden />
                        <input type="text" name='blog_post_id' value="{{ $post->id }}" hidden />
                        <button type="submit" class="btn btn-danger">Delete!</button>
                    </form>
                @endif
            </div>

    </div>
@empty
    {{-- <div class="alert alert-danger">No Comments</div> --}}
    @component('components.alert', ['type' => 'danger'])
        No Comments
    @endcomponent
    @endforelse
    @if (now()->diffInMinutes($post->created_at) < 5)
        {{-- <div class="alert alert-info">New post!</div> --}}
        @component('components.alert', ['type' => 'info'])
            New Post!
        @endcomponent
    @endif

@endsection

@section('footer')
    @include('posts.partials.footer')
@endsection()
