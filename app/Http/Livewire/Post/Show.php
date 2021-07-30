<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{

    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function like()
    {
        if ($this->post->isOwned()) {
            return;
        }

        $this->post->like();
    }

    public function render()
    {
        return view('livewire.post.show')
            ->layout('layouts.app');
    }
}
