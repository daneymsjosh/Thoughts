<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thought;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Thought $thought)
    {
        $comment = new Comment();
        $comment->thought_id = $thought->id;
        $comment->content = $request->get('content');
        $comment->save();

        return redirect()->route('thoughts.show', $thought->id)->with('success', 'Commented Successfuly!');
    }
}
