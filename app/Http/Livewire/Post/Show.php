<?php

namespace App\Http\Livewire\Post;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Post;

class Show extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Post $post;
    public string $body;
    public $image;

    public bool $isEdit_able = false;
    public string $previous;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->body = $post->body;
        // get previous redirection url
        $this->previous = URL::previous();
    }

    /**
     * Image real time validation using livewire hook
     */
    public function updatedImage()
    {
        $this->validate([
            'image' => ['image', 'max:1024'],
        ]);
    }

    /**
     * Update the post
     */
    public function update()
    {
        $this->authorize('update', $this->post);

        $validatedData = $this->validate([
            'body' => ['required'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('posts', 'public');
        }

        $this->post->update($validatedData);
        $this->isEdit_able = false;
        session()->flash('success', 'Post successfuly updated.');
    }

    /**
     * Delete the post
     */
    public function delete()
    {
        $this->authorize('delete', $this->post);
        // TODO: Add confirmation
        $this->post->delete();
        session(['success', 'Post successfuly deleted.']);
        return redirect($this->previous);
    }

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

    /**
     * make post edit-able
     */
    public function showEdit()
    {
        $this->isEdit_able = true;
    }

    public function render()
    {
        return view('livewire.post.show');
    }
}
