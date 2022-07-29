<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use App\Scopes\LatestScope;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    // public function blogPost()
    public function comment()
    {
        return $this->belongsTo(BlogPost::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);
        static::creating(function (Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
        });
        static::deleting(function (Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
        });
    }
}
