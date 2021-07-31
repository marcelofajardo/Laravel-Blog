<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Post $post;
    public string $body;
    public $image;
    public $isEdit_able = false;
    public $previous;



    public function mount(Post $post)
    {
        $this->post = $post;
        $this->body = $post->body;
        $this->previous = URL::previous();
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
    }

    public function update()
    {
        $this->authorize('update', $this->post);

        $this->validate([
            'body' => ['required']
        ]);

        $this->post->update(['body' => $this->body]);

        session('success', 'post successfuly updated');

        $this->isEdit_able = false;
    }

    public function delete()
    {
        $this->authorize('delete', $this->post);
        $this->post->delete();
        return redirect($this->previous);
    }

    public function like()
    {
        if ($this->post->isOwned()) {
            return;
        }

        $this->post->like();
    }

    public function showEdit()
    {
        $this->isEdit_able = true;
    }

    public function render()
    {
        return view('livewire.post.show');
    }
}
