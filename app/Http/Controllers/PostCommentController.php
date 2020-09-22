<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * TODO:
 * Use Livewire or JS for DRY approach
 */
class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $attribute = $request->validate([
            'body' => 'required|min:5'
            ]);
        $attribute['user_id'] = auth()->user()->id;
        $post->comments()->create($attribute);

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        // $this->authorize('delete-comment', $comment);
        $comment->delete();
        return back();
    }
}
