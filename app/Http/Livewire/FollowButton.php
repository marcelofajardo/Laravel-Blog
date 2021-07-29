<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
/**
 * Follow a user
 */
class FollowButton extends Component
{
    public $hero;

    public function follow()
    {
        Auth::user()->following()->toggle($this->hero);
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
