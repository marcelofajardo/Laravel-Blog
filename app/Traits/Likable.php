<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

// use App\Notifications\Liked;

trait Likable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function like($liked = true)
    {
        if ($this->isLiked($liked)) {
            return $this->likes()
                ->where('user_id', Auth::id())
                ->where('liked', $liked)
                ->delete();
        }

        $this->likes()->updateOrCreate(
            [
                'user_id' => Auth::id(),
                'likable_id' => $this->id
            ],
            ['liked' => $liked]
        );
        // return auth()->user()->notify(new Liked(auth()->user()));
    }

    public function dislike()
    {
        return $this->like(false);
    }

    public function isLiked($liked = true)
    {
        return (bool) $this->likes()
            ->where('user_id', Auth::id())
            ->where('liked', $liked)
            ->count() > 0;
    }

    public function isDisliked()
    {
        return $this->isLiked(false);
    }
}
