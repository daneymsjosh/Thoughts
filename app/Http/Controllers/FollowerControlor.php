<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerControlor extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->attach($user);

        Notification::createNotification($user->id, 'follow', [
            'followed_by' => $follower->name,
            'user_id' => $follower->id,
        ]);

        $existingConversation = Conversation::where(function ($query) use ($user) {
            $query->where('user_id1', Auth::id())
                ->where('user_id2', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id1', $user->id)
                ->where('user_id2', Auth::id());
        })->first();

        // If the conversation does not exist, create it
        if (!$existingConversation) {
            Conversation::create([
                'user_id1' => Auth::id(),
                'user_id2' => $user->id,
            ]);
        }

        return redirect()->back()->with('success', 'Followed Successfully!');
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->detach($user);

        Notification::createNotification($user->id, 'unfollow', [
            'unfollowed_by' => $follower->name,
            'user_id' => $follower->id,
        ]);

        return redirect()->back()->with('success', 'Unfollowed Successfully!');
    }
}
