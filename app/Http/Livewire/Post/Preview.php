<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class Preview extends Component
{
    public $post;
    public $author_name;


    public function mount()
    {
        // dd($this->post);
        $this->author_name = '@' . $this->post->hero->user->username;
    }

    public function like()
    {
        $this->post->like();
    }

    public function render()
    {
        return view('livewire.post.preview');
    }
}
