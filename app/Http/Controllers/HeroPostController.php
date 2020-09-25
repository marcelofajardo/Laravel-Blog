<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroPostController extends Controller
{
    public function __invoke(Request $request, Hero $hero)
    {
        $attributes = $request->validate([
            'body' => 'required|min:5',
            'image' => 'nullable|image|max:1024'
        ]);

        if ($request->image) {
            $attributes['image'] = $request->image->store('posts', 'public');
        }

        $hero->posts()->create($attributes);
        return back();
    }
}
