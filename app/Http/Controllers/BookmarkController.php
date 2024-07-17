<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $bookmarkIds = auth()->user()->pins()->pluck('id');

        $thoughts = Thought::whereIn('id', $bookmarkIds)->latest()->paginate(5);

        $featuredThought = $user ? $user->thoughts()->where('featured', true)->first() : null;

        if ($request->has('search')) {
            $thoughts = $thoughts->search(request('search', ''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts,
            'featuredThought' => $featuredThought
        ]);
    }


    public function pin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->attach($thought);

        return redirect()->back()->with('success', 'Added to Bookmarks!');
    }

    public function unpin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->detach($thought);

        return redirect()->back()->with('success', 'Removed from Bookmarks!');
    }
}
