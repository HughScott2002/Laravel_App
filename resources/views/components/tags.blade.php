<ul class="p-0 list-unstyled d-flex gap-2 justify-content-center align-content-center">
    @foreach ($tags as $tag)
        <li class="bg-info p-0 rounded-sm border-4 d-flex justify-content-center align-content-center">
            <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" style="text-decoration: none; font-size: 1rem;"
                class="badge badge-success fst-normal "><span>{{ $tag->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
