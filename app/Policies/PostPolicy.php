<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        return $user->id === $post->postable->id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->postable->id;
    }
}
