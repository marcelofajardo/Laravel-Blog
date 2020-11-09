<?php

namespace App\Http\Livewire;

use Livewire\Component;
/**
 * Follow a user
 */
class FollowButton extends Component
{
    public $hero;

    public function follow()
    {
        // toggle hero_user pivot table
        auth()->user()->following()->toggle($this->hero);
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
