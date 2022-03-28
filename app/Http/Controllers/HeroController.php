<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hero;
use App\Models\Post;

class HeroController extends Controller
{
    /**
     * Show the user and followed users posts
     */
    public function show(Hero $hero)
    {
        // postable/hero_id seems wrong
        $followers = $hero->user->following->pluck('id');
        $heroes = $followers->merge([$hero->id]);
        $posts_from_users = Post::where("postable_id", $hero->id)->get();
        $posts = Post::whereIn('hero_id', $heroes)->get();
        $posts = $posts->merge($posts_from_users);


        return view('hero.show', [
            'hero' => $hero,
            'posts' => $posts
        ]);
    }

    public function edit(Hero $hero)
    {
        $this->authorize('update', $hero);
        return view('hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $this->authorize('update', $hero);
        $request->validate(['bio' => 'required|min:5']);
        $hero->update($request->only('bio'));

        return redirect("users/heroes/{$hero->id}")->with('success', 'Hero successfuly updated');
    }
}
