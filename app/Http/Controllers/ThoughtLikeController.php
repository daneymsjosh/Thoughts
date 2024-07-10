<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtLikeController extends Controller
{
    public function like(Thought $thought)
    {
        $liker = auth()->user();

        $liker->likes()->attach($thought);

        return redirect()->route('dashboard', $thought->id)->with('success', 'Liked Successfully!');
    }

    public function unlike(Thought $thought)
    {
        $liker = auth()->user();

        $liker->likes()->detach($thought);

        return redirect()->route('dashboard', $thought->id)->with('success', 'Unliked Successfully!');
    }
}
