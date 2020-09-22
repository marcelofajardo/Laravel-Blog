<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Post;
use Illuminate\Http\Request;

class HeroPostController extends Controller
{
    //
    public function store(Request $request, Hero $hero)
    {
        $attributes = $request->validate([
            'title' => 'nullable|min:5|max:255',
            'body' => 'required|min:5|max:255',
            'image' => 'nullable|image|max:1024'
        ]);
        $attributes['user_id'] = auth()->user()->id;

        if ($request->image) {
            $attributes['image'] = $request->image->store('posts', 'public');
        }

        $hero->posts()->create($attributes);
        return back();
    }
    public function show(Hero $hero, Post $post)
    {
        $post->increment('views_count');
        return view('hero.show-post', compact('hero', 'post'));
    }

    public function edit(Hero $hero, Post $post)
    {
        return view('hero.edit-post', compact('hero', 'post'));
    }
    public function Update(Request $request, Hero $hero, Post $post)
    {
        $attributes = $request->validate([
            'title' => 'nullable|min:5|max:255',
            'body' => 'required|min:5|max:255',
            'image' => 'nullable|image|max:1024'
        ]);
        $attributes['user_id'] = auth()->user()->id;

        if ($request->image) {
            $attributes['image'] = $request->image->store('posts', 'public');
        }

        $hero->posts()->update($attributes);
        return redirect('/hero/'.$hero->id.'/post/'.$post->id);
    }

    public function destroy(Hero $hero, Post $post)
    {
        $post->delete();
        return redirect('/user/hero/'.$hero->id);
    }
}
