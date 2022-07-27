<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments;
use App\Models\Comment;
use Illuminate\Auth\Events\Verified;
use Mockery\Undefined;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //

    public function store(Comments $request)
    {
        $verified = $request->validated();
        $comment = new Comment();
        $comment->content = $verified['comment'];
        $blog_post_id = $verified['blog_post_id'];
        $comment->blog_post_id = $blog_post_id;
        $comment->save();

        session()->flash('Status-success', 'Comment has been added!');

        return redirect()->route('posts.show', ['post' => $blog_post_id]);
    }

    public function destroy(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $comment->delete();
        session()->flash('Status-success', 'Comment deleted!');

        return redirect()->route('posts.show', ['post' => $request->blog_post_id]);
    }
}
