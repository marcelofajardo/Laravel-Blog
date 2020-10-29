<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroFollowController extends Controller
{
    public function __invoke(Request $request, Hero $hero)
    {
        $request->user()->following()->toggle($hero);
        return back();
    }
}
