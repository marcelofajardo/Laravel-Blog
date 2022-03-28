<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Traits\Postable;

class Hero extends Model
{
    use HasFactory, Postable;

    protected $fillable = ['bio'];
    protected $with = ['posts'];

    /**
     * Get the hero's user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get heroes followers
     */
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * User route path
     */
    public function path($append = 'index')
    {
        return route("heroes.{$append}", [$this->id]);
    }

    /**
     * Check if user owned the hero.
     */
    public function isOwned()
    {
        return Auth::id() == $this->id;
    }

    public function getAvatarAttribute()
    {
        return $this->user->profile_photo_url;
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

    public function getPostsAndFollowersPostsAttribute() {
        // posts from followed user and this user
        $followers = $this->user->following->pluck('id');
        $heroes_ids = $followers->merge([$this->id]);
        $posts = Post::whereIn('hero_id', $heroes_ids)->get();

        // this user posts on other users
        $posts_on_other_users = Post::where("postable_id", $this->id)->get();
        $posts = $posts->merge($posts_on_other_users);

        return $posts;
    }
}
