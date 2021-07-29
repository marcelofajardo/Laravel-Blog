<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->increment('views_count');
        return view('post.show', [
            'post' => $post,
            'comments' => $post->comments
        ]);
    }

    // TODO: convert to livewirr
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'body' => 'required|min:5',
        ]);

        $post->update($validatedData);

        return redirect("/post/{$post->id}")->with('success', 'post successfuly updated.');
    }

    // TODO: convert to livewire
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect("/users/heroes/{$post->postable->id}");
    }
}
