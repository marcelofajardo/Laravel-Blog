<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class Show extends Component
{
    public $post;
    public $author_name;

    public function mount()
    {
        $this->author_name = '@' . $this->post->postable->username;
    }

    public function render()
    {
        return view('livewire.post.show');
    }
}
