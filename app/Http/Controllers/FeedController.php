<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $followingIDs = auth()->user()->followings()->pluck('user_id');

        $thoughts = Thought::whereIn('user_id', $followingIDs)->latest();

        if ($request->has('search')) {
            $thoughts = $thoughts->where('content', 'like', '%' . $request->get('search', '') . '%');
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(5)
        ]);
    }
}
