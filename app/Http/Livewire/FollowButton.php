<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FollowButton extends Component
{
    public $hero;

    public function follow()
    {
        auth()->user()->following()->toggle($this->hero);
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
