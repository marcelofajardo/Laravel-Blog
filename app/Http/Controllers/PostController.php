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
        return view('post.show', compact('post','comments'));
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
