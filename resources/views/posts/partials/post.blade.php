<div class="flex justify-content-center">
    <div class="card">
        @if (now()->diffInMinutes($post->created_at) < 5)
            <div class="card-header bg-info">
                Featurd Post: Now!
            </div>
        @elseif (now()->diffInMinutes($post->created_at) < 60)
            <div class="card-header">

                Featurd Post: Hour
            </div>
        @elseif (now()->diffInMinutes($post->created_at) < 1440)
            <div class="card-header ">

                Featurd Post: Today
            </div>
        @else
            <div class="card-header">
                Featurd Post
            </div>
        @endif

        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                    {{ $post->title }}
                </a>
            </h5>
            <h6 class="card-subtitle mb-2 mt-1 text-muted">
                Created: {{ $post->created_at->diffForHumans() }}

            </h6>
            <p class="card-text mb-3">
                {{ $post->content }}
            </p>
            <hr />

            <div class="d-flex bg-highlight justify-content-center align-content-center ">
                <div>
                    <a class='btn btn-primary px-4' href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
                </div>
                <form class='mx-3' action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block"> DELETE!</button>
                </form>
            </div>

        </div>
    </div>
</div>