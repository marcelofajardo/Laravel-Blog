<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

// TODO: convert to livewire
class CommentController extends Controller
{
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validatedData = $request->validate([
            'body' => 'required|min:5'
        ]);

        $comment->update($validatedData);

        return redirect("/posts/{$comment->commentable->id}");
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }
}
