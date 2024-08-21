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
        $conversations = Conversation::where('user_id1', Auth::id())->orWhere('user_id2', Auth::id())->orderBy("updated_at", 'desc')->get();

        $viewing = false;

        return view('conversations.index', compact('conversations', 'viewing'));
    }

    public function show(Conversation $conversation)
    {
        $conversations = Conversation::where('user_id1', Auth::id())->orWhere('user_id2', Auth::id())->orderBy("updated_at", 'desc')->get();

        $messages = Message::where('conversation_id', $conversation->id)->get();

        $viewing = true;

        return view('conversations.index', compact('conversations', 'viewing', 'messages', 'conversation'));
    }
}
