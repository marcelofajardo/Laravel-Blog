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
        $followers = $hero->user->following->pluck('id');
        $heroes = $followers->merge([$hero->id]);
        $posts = Post::whereIn('hero_id', $heroes)->get();

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
