<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->like();
        return back();
    }
}
