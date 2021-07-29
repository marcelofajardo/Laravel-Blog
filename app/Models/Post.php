<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Commentable;
use App\Traits\Likable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use Commentable;
    use Likable;

    protected $fillable = ['body', 'image', 'user_id'];
    protected $with = ['comments'];

    /**
     * Get the parent postable model
     */
    public function postable()
    {
        return $this->morphTo();
    }

    /**
     * Check if auth user owned the post
     */
    public function isOwned()
    {
        return Auth::id() === $this->postable->id;
    }

    /**
     * Post route path
     */
    public function path($append = "index")
    {
        return route("posts.$append", $this->id);
    }

    public function getAuthorIdAttribute()
    {
        return $this->postable->id;
    }

    public function getAuthorNameAttribute()
    {
        return '@' . $this->postable->username;
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function getCreatedAtAttribute()
    {
        $createdAt = $this->attributes['created_at'];
        return Carbon::parse($createdAt)->diffForHumans();
    }
}
