<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thought;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Thought $thought)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();
        $validated['thought_id'] = $thought->id;

        Comment::create($validated);

        Notification::createNotification($thought->user_id, 'comment', [
            'commented_by' => Auth::user()->name,
            'post_id' => $thought->id,
        ]);

        return redirect()->back()->with('success', 'Commented Successfuly!');
    }
}
