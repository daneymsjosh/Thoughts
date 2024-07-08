<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        // Validate content
        $validated = $request->validate([
            'content' => 'required|min:5|max:240'
        ]);

        $validated['user_id'] = auth()->id();

        // Create content
        Thought::create($validated);

        return redirect()->route('dashboard')->with('success', 'Thought Created Successfuly!');
    }

    public function edit(Thought $thought)
    {
        if (auth()->id() !== $thought->user_id) {
            abort(404);
        }

        $editing = true;

        return view('thoughts.show', compact('thought', 'editing'));
    }

    public function update(Request $request, Thought $thought)
    {
        if (auth()->id() !== $thought->user_id) {
            abort(404);
        }

        // Validate content
        $validated = $request->validate([
            'content' => 'required|min:5|max:240'
        ]);

        $thought->update($validated);

        return redirect()->route('thoughts.show', $thought->id)->with('success', 'Thought Updated Successfuly!');
    }

    public function show(Thought $thought)
    {
        return view('thoughts.show', compact('thought'));
    }

    public function destroy(Thought $thought)
    {
        if (auth()->id() !== $thought->user_id) {
            abort(404);
        }

        // Delete content
        $thought->delete();

        return redirect()->route('dashboard')->with('success', 'Thought Deleted Successfuly!');
    }
}
