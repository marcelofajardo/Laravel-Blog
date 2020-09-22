<?php

namespace App\Traits;

trait Postable
{
    public function posts()
    {
        return $this->morphMany('App\Models\Post', 'postable')
            ->orderBy('created_at', 'DESC');
    }
}
