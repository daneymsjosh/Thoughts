<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        Notification::createNotification($thought->user_id, 'like', [
            'liked_by' => $liker->name,
            'post_id' => $thought->id,
        ]);

        return redirect()->back()->with('success', 'Liked Successfully!');
    }

    public function unlike(Thought $thought)
    {
        $liker = auth()->user();

        $liker->likes()->detach($thought);

        Notification::createNotification($thought->user_id, 'unlike', [
            'unliked_by' => $liker->name,
            'post_id' => $thought->id,
        ]);

        return redirect()->back()->with('success', 'Unliked Successfully!');
    }
}
