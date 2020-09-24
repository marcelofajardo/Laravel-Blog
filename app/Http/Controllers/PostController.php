<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', $post);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'nullable|min:5|max:255',
            'body' => 'required|min:5|max:255',
            'image' => 'nullable|image|max:1024'
        ]);
        $post->update($attributes);
    }

    public function delete(Request $request, Post $post)
    {
        $post->delete();
    }
}
