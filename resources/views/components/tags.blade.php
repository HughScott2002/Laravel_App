<ul class="p-0 list-unstyled d-flex gap-5 justify-content-center align-content-center">
    @foreach ($tags as $tag)
        <li class="bg-info p-0 rounded-pill border-2 border-dark">
            <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}"
                class="badge badge-success fs-5 fst-normal"><span>{{ $tag->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
