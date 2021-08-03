<?php

namespace App\Http\Livewire\Comment;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public Post $post;

    public function render()
    {
        return view('livewire.comment.index');
    }
}
