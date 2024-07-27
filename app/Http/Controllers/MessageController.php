<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // $conversations = Conversation::where('user_id1', Auth::id())->orWhere('user_id2', Auth::id())->get();

        $user = Auth::user();

        $followingIds = auth()->user()->followings()->pluck('user_id');

        $followings = User::whereIn('id', $followingIds)->get();

        return view('messages.index', compact('followings'));
    }

    public function show(Conversation $conversation)
    {
        // $this->authorize('view', $conversation);

        $messages = $conversation->messages()->with('sender')->latest()->paginate(10);

        return view('messages.show', compact('conversation', 'messages'));
    }

    public function store(Request $request, Conversation $conversation)
    {
        // $this->authorize('view', $conversation);

        $request->validate([
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->message = $request->message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $conversation->user_id1 == Auth::id() ? $conversation->user_id2 : $conversation->user_id1;
        $message->conversation_id = $conversation->id;
        $message->save();

        $conversation->last_message_id = $message->id;
        $conversation->save();

        return redirect()->route('messages.show', $conversation->id);
    }
}
