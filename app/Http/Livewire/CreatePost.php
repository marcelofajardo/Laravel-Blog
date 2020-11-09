<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * Create a post
 */
class CreatePost extends Component
{
    use WithFileUploads;

    public $model;
    public $body;
    public $image;

    // live view image
    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        // validate request
        $attributes =  $this->validate([
            'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024',
        ]);

        // validate if image exist
        if ($this->image)
            // store image and set image attribute
            $attributes['image'] = $attributes['image']->store('posts', 'public');

        // create post
        $model->posts()->create($attributes);
        // create success message
        session()->flash('success', 'Post successfully Created.');
        // clear user input
        $this->body = null;
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
