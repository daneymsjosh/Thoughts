<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $validated['sender_id'] = Auth::id();
        $validated['conversation_id'] = $conversation->id;
        $validated['receiver_id'] = ($conversation->user_id1 == Auth::id()) ? $conversation->user_id2 : $conversation->user_id1;

        Message::create($validated);

        // Update the conversation with the last message
        $conversation->update(['last_message_id' => $conversation->messages()->latest()->first()->id]);

        return redirect()->route('conversations.show', $conversation->id);
    }
}
