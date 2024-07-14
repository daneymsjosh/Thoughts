<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $bookmarkIds = auth()->user()->pins()->pluck('id');

        $thoughts = Thought::whereIn('id', $bookmarkIds)->latest();

        if ($request->has('search')) {
            $thoughts = $thoughts->search(request('search', ''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(5)
        ]);
    }

    public function pin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->attach($thought);

        return redirect()->route('dashboard', $thought->id)->with('success', 'Added to Bookmarks!');
    }

    public function unpin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->detach($thought);

        return redirect()->route('dashboard', $thought->id)->with('success', 'Removed from Bookmarks!');
    }
}
