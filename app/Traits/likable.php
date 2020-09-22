<?php

namespace App\Traits;

trait Likable
{
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likable');
    }

    public function like($liked = true)
    {
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

    public function isLiked(User $user)
    {
        return (bool) $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', true)
            ->count();
    }

    public function isDisliked(User $user)
    {
        return (bool) $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', false)
            ->count();
    }
}
