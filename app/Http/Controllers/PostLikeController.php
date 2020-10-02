<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        // like
        // remove like
        $post->like();

        return back();
    }
}
