<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
    public function show(Hero $hero)
    {
        $posts = $hero->posts;
        return view('hero.show', compact('hero', 'posts'));
    }

    public function edit(Hero $hero)
    {
        $this->authorize('update', $hero);
        return view('hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $this->authorize('update', $hero);

        $attributes = $request->validate([
            'bio' => 'required|min:5'
        ]);

        $hero->update($attributes);
        return redirect("user/hero/$hero->id");
    }
}
