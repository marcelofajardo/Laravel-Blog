<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
    /**
     * Like a post
     */
    public function __invoke(Post $post)
    {
        $post->like();

        return back()->with('success', 'post successfuly liked.');
    }
}
