<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = now()->addMinutes(10);
        $mostCommented = Cache::tags(['blog-post'])->remember('blog-post-mostCommented', $time, function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $posts = Cache::tags(['blog-post'])->remember('blog-post-posts', $time, function () {
            return BlogPost::Latest()->withCount('comments')->with('user')->get();
        });
        $mostActive = Cache::remember('blog-post-mostActive', $time, function () {
            return User::withMostBlogPosts()->take(3)->get();
        });
        $mostActiveLastMonth = Cache::remember('blog-post-mostActiveLastMonth', $time, function () {
            return User::WithMostBlogPostsLastMonth()->take(5)->get();
        });

        return view(
            'posts.index',
            [
                'posts' => $posts,
                'mostCommented' => $mostCommented,
                'mostActive' => $mostActive,
                'mostActiveLastMonth' => $mostActiveLastMonth
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = BlogPost::create($validated);

        // $post->title = $validated['title'];
        // $post->content = $validated['content'];
        // $post->fill();
        // $post->save();

        // BlogPost::make();
        // BlogPost::create();

        $request->session()->flash("Status-success", 'The Blog Post was created!');

        return redirect()
            ->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments', 'user')->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }
        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }
        $usersUpdate[$sessionId] = $now;

        Cache::tags(['blog-post'])->put($usersKey, $usersUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view(
            'posts.show',
            [
                'post' => $blogPost,
                'counter' => $counter,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403);
        // }
        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()
            ->flash("Status-success", "Your Record Has been updated");

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);
        $post = BlogPost::findOrFail($id);
        // if (Gate::denies('delete-post', $post)) {
        //     abort(403);
        // }
        $this->authorize('delete', $post);

        $post->delete();

        session()->flash('Status-success', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }
}
