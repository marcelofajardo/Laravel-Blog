<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $model;
    public $body;
    public $image;
    public $uploaded_filename;

    // live view image
    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);

        $this->uploaded_filename = $this->image->getClientOriginalName();
    }

    public function save()
    {
        $validatedData =  $this->validate([
            'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            $attributes['image'] = $validatedData['image']->store('posts', 'public');
        }

        $this->model->posts()->create($validatedData);

        $this->body = null;
        $this->image = null;

        session()->flash('success', 'Post successfully Created.');
    }
    public function render()
    {
        return view('livewire.post.create');
    }
}
