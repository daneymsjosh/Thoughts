<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $followingIDs = auth()->user()->followings()->pluck('user_id');

        $thoughts = Thought::whereIn('user_id', $followingIDs)->latest()->paginate(5);

        $featuredThought = $user ? $user->thoughts()->where('featured', true)->first() : null;

        if ($request->has('search')) {
            $thoughts = $thoughts->search(request('search', ''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts,
            'featuredThought' => $featuredThought
        ]);
    }
}
