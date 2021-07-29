<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required|min:5|max:255'
        ]);

        $validatedData['user_id'] = Auth::id();

        $post->comments()->create($validatedData);
        return back()->with('success', 'Comment successfuly created.');
    }
}
