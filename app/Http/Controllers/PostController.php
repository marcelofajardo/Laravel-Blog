<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // public function show(Post $post)
    // {
    //     $post->increment('views_count');
    //      return view('livewire.Post.show', compact('post'));
    //     // return view('post.show', compact('post'));
    // }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect("/posts/{$post->id}")->with('success', 'post successfuly updated.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect("/users/heroes/{$post->postable->id}");
    }
}
