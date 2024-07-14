<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class PinThoughtController extends Controller
{
    public function pin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->attach($thought);

        return redirect()->route('bookmark', $thought->id)->with('success', 'Pinned Thought Successfuly!');
    }

    public function unpin(Thought $thought)
    {
        $owner = auth()->user();

        $owner->pins()->detach($thought);

        return redirect()->route('bookmark', $thought->id)->with('success', 'Unpinned Thought Successfuly!');
    }
}
