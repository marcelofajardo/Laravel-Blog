<?php

namespace App\Http\Livewire\Post;

use App\Models\Hero;
use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public Hero $hero;
    public $posts;

    protected $listeners = ['refresh-post' => '$refresh'];

    public function render()
    {
        return view('livewire.post.index');
    }
}
