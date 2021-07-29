<?php

namespace App\Traits;

use App\Models\Post;

trait Postable
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable')
            ->latest();
    }
}
