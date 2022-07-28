<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    // public function blogPost()
    public function comment()
    {
        return $this->belongsTo(BlogPost::class);
    }
    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);
        // static::updating(function (BlogPost $blogPost) {
        //     Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        // });
        // static::deleting(function (BlogPost $blogPost) {
        //     Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        // });
    }
}
