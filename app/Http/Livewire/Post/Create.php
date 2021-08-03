<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;

class Create extends Component
{

    use WithFileUploads;

    public object $model;
    public string $body = '';
    public ?TemporaryUploadedFile $image;
    public string $uploaded_filename;

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);

        // $this->uploaded_filename = $this->image->getClientOriginalName();
    }

    public function save()
    {
        $validatedData =  $this->validate([
            'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024',
        ]);

        if (isset($this->image)) {
            $validatedData['image'] = $validatedData['image']->store('posts', 'public');
        }

        $this->model->posts()->create($validatedData);

        $this->body = '';
        $this->image = null;

        $this->emitUp('refresh-post');

        session()->flash('success', 'Post successfully Created.');
    }
    public function render()
    {
        return view('livewire.post.create');
    }
}
