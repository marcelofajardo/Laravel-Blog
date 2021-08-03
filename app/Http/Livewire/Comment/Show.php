<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;

class Show extends Component
{
    public Comment $comment;
    public string $body;
    public bool $isEdit_able = true;

    public function mount()
    {
        $this->body = $this->comment->body;
    }

    public function render()
    {
        return view('livewire.comment.show');
    }
}
