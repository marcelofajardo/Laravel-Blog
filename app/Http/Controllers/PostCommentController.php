<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $attributes = $request->validate([
            'body' => 'required|min:5|max:255'
        ]);

        $attributes['user_id'] = auth()->user()->id;

        $post->comments()->create($attributes);
        return back();
    }
}
