<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
    public function show(Hero $hero)
    {
        return view('hero.show', [
            'hero' => $hero,
            'posts' => $hero->posts
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

        $validatedData = $request->validate([
            'bio' => 'required|min:5'
        ]);

        // TODO: can validate User data

        $hero->update($validatedData);

        return redirect("users/heroes/{$hero->id}")->with('success', 'Hero successfuly updated');
    }
}
