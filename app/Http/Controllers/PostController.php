<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $comments = $post->comments;
        $post->increment('views_count');
        return view('post.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $attributes = $request->validate([
            'body' => 'required|min:5',
        ]);

        $post->update($attributes);
        return redirect('/post/' . $post->id);
    }

    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/user/hero/' . $post->postable->id);
    }
}
