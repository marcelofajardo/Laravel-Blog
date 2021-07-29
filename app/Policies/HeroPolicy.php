<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Hero;

class HeroPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Hero $hero)
    {
        return $user->id === $hero->id;
    }
}
