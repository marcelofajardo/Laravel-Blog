<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentLikesController extends Controller
{
    //
    public function store(Comment $comment)
    {
        $comment->like();
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->dislike();
        return back();
    }
}
