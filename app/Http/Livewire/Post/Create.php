<?php

namespace App\Http\Livewire\Post;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public object $model;
    public string $body = '';
    public  $image;
    public string $uploaded_filename;

    /**
     * Image real time validation usng livewire hook
     */
    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);

        $this->uploaded_filename = $this->image->getClientOriginalName();
    }

    /**
     * Save the post
     */
    public function save()
    {
        $validatedData =  $this->validate([
            'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('posts', 'public');
        }

        $validatedData['hero_id'] = Auth::id();

        $this->model->posts()->create($validatedData);

        $this->body = '';
        $this->image = null;

        $this->emitUp('refresh-posts');

        session()->flash('success', 'Post successfully Created.');
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}
