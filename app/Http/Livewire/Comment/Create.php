<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public Post $post;
    public string $body = '';

    /**
     * Save the comment
     */
    public function save()
    {
        $this->validate([
            'body' => ['required', 'min:5']
        ]);

        $this->post->comments()->create([
            'body' => $this->body,
            'user_id' => Auth::id()
        ]);

        $this->body = '';

        $this->emitUp('refresh-comments');

        session()->flash('success', 'Comment successfuly created');
    }

    public function render()
    {
        return view('livewire.comment.create');
    }
}
