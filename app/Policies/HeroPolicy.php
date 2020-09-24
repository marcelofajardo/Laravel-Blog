<?php

namespace App\Policies;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeroPolicy
{
    use HandlesAuthorization;
    public function update(User $user, Hero $hero)
    {
        //
        return $user->id === $hero->id;
    }
}
