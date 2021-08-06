<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Hero;

class Index extends Component
{
    public Hero $hero;
    public $posts;

    protected $listeners = ['refresh-posts' => '$refresh'];

    public function render()
    {
        return view('livewire.post.index');
    }
}
