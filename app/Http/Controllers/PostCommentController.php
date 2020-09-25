<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

/**
 * TODO:
 * Use Livewire or JS for DRY approach
 */
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
