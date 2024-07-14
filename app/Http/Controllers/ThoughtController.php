<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThoughtRequest;
use App\Http\Requests\UpdateThoughtRequest;
use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ThoughtController extends Controller
{
    public function store(StoreThoughtRequest $request, Thought $thought)
    {
        // Validate content
        $validated = $request->validated();

        if ($request->has('image')) {
            if ($thought->image) {
                Storage::disk('public')->delete($thought->image);
            }

            $imagePath = $request->file('image')->store('thought', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['user_id'] = auth()->id();

        // Create content
        Thought::create($validated);

        return redirect()->route('dashboard')->with('success', 'Thought Created Successfuly!');
    }

    public function edit(Thought $thought)
    {
        Gate::authorize('update', $thought);

        $editing = true;

        return view('thoughts.show', compact('thought', 'editing'));
    }

    public function update(UpdateThoughtRequest $request, Thought $thought)
    {
        Gate::authorize('update', $thought);

        // Validate content
        $validated = $request->validated();

        if ($request->has('image')) {
            if ($thought->image) {
                Storage::disk('public')->delete($thought->image);
            }

            $imagePath = $request->file('image')->store('thought', 'public');
            $validated['image'] = $imagePath;
        }

        $thought->update($validated);

        return redirect()->route('thoughts.show', $thought->id)->with('success', 'Thought Updated Successfuly!');
    }

    public function show(Thought $thought)
    {
        return view('thoughts.show', compact('thought'));
    }

    public function destroy(Thought $thought)
    {
        Gate::authorize('delete', $thought);

        // Delete content
        $thought->delete();

        return redirect()->route('dashboard')->with('success', 'Thought Deleted Successfuly!');
    }
}
