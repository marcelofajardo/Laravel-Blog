<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $model;
    public $body;
    public $image;

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
    }

    public function save()
    {
       $attributes =  $this->validate([
           'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            $attributes['image'] = $attributes['image']->store('posts', 'public');
        }
        $this->model->posts()->create($attributes);
        session()->flash('success', 'Post successfully Created.');
        $this->body = null;
        $this->image = null;

    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
