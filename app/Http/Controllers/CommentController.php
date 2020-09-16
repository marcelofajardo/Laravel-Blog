<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

// USE LIVEWIRE
class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post, Comment $comment)
    {
        //
        $attribute = $request->validate([
            'body' => 'required|min:5|max:255'
            ]);
            $attribute['user_id'] = auth()->user()->id;

        $post->comments()->create($attribute);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        //
        $this->authorize('update', $post);
        return view('comments.edit',compact('post','comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        //
        $this->authorize('update', $post);
        $attribute = $request->validate([
            'body' => 'required|min:5'
            ]);
            $attribute['user_id'] = auth()->user()->id;

            $post->comments()->update($attribute);

            return redirect('/posts/'.$post->id);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Comment  $comment
         * @return \Illuminate\Http\Response
         */
        public function destroy(Post $post, Comment $comment)
        {
            //
            $this->authorize('delete', $post);
            $comment->delete();
            return redirect('/posts/'.$post->id);
        }
    }
