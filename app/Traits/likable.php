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
}
