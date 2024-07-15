<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtLikeController extends Controller
{
    public function __invoke(Request $request)
    {
        $likedIds = auth()->user()->likes()->pluck('id');

        $thoughts = Thought::whereIn('id', $likedIds)->latest();

        if ($request->has('search')) {
            $thoughts = $thoughts->search(request('search', ''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(5)
        ]);
    }

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
