<?php



namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
    public function compose(View $view)
    {
        $time = now()->addMinutes(60);
        $mostCommented = Cache::tags(['blog-post'])->remember('blog-post-mostCommented', $time, function () {
            return BlogPost::mostCommented()->take(5)->get();
        });
        $mostActive = Cache::remember('blog-post-mostActive', $time, function () {
            return User::withMostBlogPosts()->take(3)->get();
        });
        $mostActiveLastMonth = Cache::remember('blog-post-mostActiveLastMonth', $time, function () {
            return User::WithMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
