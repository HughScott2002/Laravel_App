<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments;
use App\Models\Comment;
use Illuminate\Auth\Events\Verified;
use Mockery\Undefined;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }
    public function store(Comments $request)
    {
        // dd($request);
        $verified = $request->validated();
        // dd($verified);
        $comment = new Comment();
        $comment->content = $verified['comment'];
        $blog_post_id = (int) $verified['blog_post_id'];
        $comment->blog_post_id = $blog_post_id;
        $user_id = (int) $verified['user_id'];
        if ($user_id === null || $user_id <= 0) {
            return redirect()->route('login');
        }
        $comment->user_id = $user_id;

        $comment->save();

        Cache::tags(['blog-post'])->forget("blog-post-{$blog_post_id}");
        session()->flash('Status-success', 'Comment has been added!');
        return redirect()->route('posts.show', ['post' => $blog_post_id]);
    }

    public function destroy(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $blog_post_id = $comment->blog_post_id;
        $comment->delete();

        Cache::tags(['blog-post'])->forget("blog-post-{$blog_post_id}");
        session()->flash('Status-success', 'Comment deleted!');

        return redirect()->route('posts.show', ['post' => $request->blog_post_id]);
    }
}
