<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('user_id1', Auth::id())->orWhere('user_id2', Auth::id())->get();

        $viewing = false;

        if ($conversations->isEmpty()) {
            $followingIds = auth()->user()->followings()->pluck('users.id');
            $followings = User::whereIn('id', $followingIds)->get();

            return view('conversations.index', compact('followings', 'viewing'));
        }

        return view('conversations.index', compact('conversations', 'viewing'));
    }

    public function show(Conversation $conversation)
    {
        $conversations = Conversation::where('user_id1', Auth::id())->orWhere('user_id2', Auth::id())->get();

        $messages = Message::where('conversation_id', $conversation->id)->get();

        $viewing = true;

        return view('conversations.index', compact('conversations', 'viewing', 'messages', 'conversation'));
    }

    public function create(User $user)
    {
        $existingConversation = Conversation::where(function ($query) use ($user) {
            $query->where('user_id1', Auth::id())
                ->where('user_id2', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id1', $user->id)
                ->where('user_id2', Auth::id());
        })->first();

        // If the conversation already exists, redirect to the conversation
        if ($existingConversation) {
            return redirect()->route('conversations.show', $existingConversation->id);
        }

        // Otherwise, create a new conversation
        $conversation = Conversation::create([
            'user_id1' => Auth::id(),
            'user_id2' => $user->id,
        ]);

        return redirect()->route('conversations.show', $conversation->id);
    }
}
