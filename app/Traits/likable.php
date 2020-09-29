<?php

namespace App\Traits;

use App\Models\User;

trait Likable
{
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likable');
    }

    public function like($liked = true)
    {
        if ($this->isLiked($liked)) {
            return $this->likes()
                ->where('user_id', auth()->user()->id)
                ->where('liked', $liked)
                ->delete();
        }

        $this->likes()->updateOrCreate(
            [
              'user_id' => auth()->id(),
              'likable_id' => $this->id
            ],
            [ 'liked' => $liked ]
        );
    }

    public function dislike()
    {
        return $this->like(false);
    }

    public function isLiked($liked = true)
    {
        return (bool) $this->likes()
            ->where('user_id', auth()->user()->id)
            ->where('liked', $liked)
            ->count();
    }

    public function isDisliked()
    {
        return $this->isLiked(false);
    }
}
