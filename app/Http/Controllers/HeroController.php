<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Http\Request;

class HeroController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Hero $hero)
    {
        //
        return view('hero.show', compact('hero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Hero $hero)
    {
        //
        return view('hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Hero $hero)
    {
        //
        $attributes = $request->validate([
            'bio' => 'required|min:5|max:255'
        ]);
        $user->hero->update($attributes);
        return redirect("/user/$user->id/hero/$hero->id");
    }
}
