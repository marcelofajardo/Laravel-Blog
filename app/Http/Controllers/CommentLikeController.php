<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentLikeController extends Controller
{
    /**
     * Like a comment
     */
    public function store(Request $request, Comment $comment)
    {
        $comment->like();
        return back();
    }

    /**
     * Dislike a comment
     */
    public function destroy(Comment $comment)
    {
        $comment->dislike();
        return back();
    }
}
