<?php

namespace App\Http\Livewire\Comment;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Comment;

class Show extends Component
{
    use AuthorizesRequests;

    public Comment $comment;
    public string $body;
    public bool $isEdit_able = false;

    public function mount()
    {
        $this->body = $this->comment->body;
    }

    public function update()
    {
        $this->authorize('update', $this->comment);

        $validatedData = $this->validate([
            'body' => ['required']
        ]);

        $this->comment->update($validatedData);
        $this->emitUp('refresh-comments');
        $this->isEdit_able = false;

        session()->flash('success', 'Comment updated successfuly.');
    }

    /**
     * TODO: Add validation
     */
    public function delete()
    {
        $this->authorize('delete', $this->comment);
        $this->comment->delete();
        $this->emitUp('refresh-comments');
        session()->flash('success', 'Comment deleted successfuly.');
    }

    public function like()
    {
        $this->comment->like();
    }

    public function dislike()
    {
        $this->comment->dislike();
    }

    public function showEdit()
    {
        $this->isEdit_able = true;
    }

    public function render()
    {
        return view('livewire.comment.show');
    }
}
