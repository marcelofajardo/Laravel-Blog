<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Post;
use App\Models\Comment;


class HeroPostCommentController extends Controller
{
    public function edit(Hero $hero, Post $post, Comment $comment)
    {
        return view('hero.edit-comment', compact('hero', 'post', 'comment'));
    }

    public function update(Hero $hero, Post $post, Comment $comment)
    {
        $this->authorize('comment-update', $comment);

        $attributes = request()->validate([
            'body' => 'required|min:5|max:255'
        ]);

        $comment->update($attributes);
        return redirect('/hero/'. $hero->id.'/post/'.$post->id);
    }
}
