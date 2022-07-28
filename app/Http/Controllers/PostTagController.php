<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $time = now()->addMinutes(5);
        $tag = Cache::tags(['tags'])->remember("tag{$tag}", $time, function () use ($tag) {
            return Tag::findOrFail($tag);
        });
        $bp = Cache::tags(['blog-post'])->remember("blog-post-tag-{$tag}", $time, function () use ($tag) {
            return $tag->blogPosts;
        });

        return view('posts.index', [
            'posts' => $bp
        ]);
    }
}
