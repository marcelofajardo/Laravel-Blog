<?php

namespace App\Policies;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hero  $hero
     * @return mixed
     */
    public function update(User $user, Hero $hero)
    {
        //
        return $user->id === $hero->id;
    }
}
