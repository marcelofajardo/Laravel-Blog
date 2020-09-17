<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Like;

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
