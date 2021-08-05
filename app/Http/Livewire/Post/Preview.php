<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Post;

class Preview extends Component
{
    public Post $post;

    /**
     * Like the post
     */
    public function like()
    {
        if ($this->post->isOwned()) {
            return;
        }

        $this->post->like();
    }

    public function render()
    {
        return view('livewire.post.preview');
    }
}
