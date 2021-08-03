<?php

namespace App\Http\Livewire\Comment;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public Post $post;

    protected $listeners = ['refresh-comments' => '$refresh'];

    public function render()
    {
        return view('livewire.comment.index');
    }
}
