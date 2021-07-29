<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Likable;

class Comment extends Model
{
    use HasFactory;
    use likable;

    protected $fillable = ['body', 'user_id'];

    /**
     * Get the parent commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the comment's user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comments route path
     */
    public function path($append = "index")
    {
        return route("comments.$append", $this->id);
    }

    /**
     * Get the difference of likes and dislikes
     */
    public function getTotalLikesAttribute()
    {
        $likes = $this->likes()->where('liked', true)->count();
        $dislikes = $this->likes()->where('liked', false)->count();
        return $likes - $dislikes;
    }
}
