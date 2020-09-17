<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

// USE LIVEWIRE
class PostCommentController extends Controller
{

    public function store(Request $request, Post $post, Comment $comment)
    {
        $attribute = $request->validate([
            'body' => 'required|min:5|max:255'
            ]);
        $attribute['user_id'] = auth()->user()->id;

        $post->comments()->create($attribute);

        return back();
    }

    public function edit(Post $post, Comment $comment)
    {
        $this->authorize('update-comment', $comment);
        return view('comments.edit', compact('post', 'comment'));
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update-comment', $comment);
        $attribute = $request->validate([
            'body' => 'required|min:5|max:255'
            ]);

        $comment->update($attribute);

        return redirect('/posts/'.$post->id);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete-comment', $comment);
        $comment->delete();
        return redirect('/posts/'.$post->id);
    }
}
