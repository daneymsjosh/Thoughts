<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Thought;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Thought $thought)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        $validated['thought_id'] = $thought->id;

        Comment::create($validated);

        return redirect()->route('thoughts.show', $thought->id)->with('success', 'Commented Successfuly!');
    }
}
