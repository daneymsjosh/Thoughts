<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        // Validate content
        $request->validate([
            'thought-content' => 'required|min:5|max:240'
        ]);

        // Create content
        $thought = Thought::create([
            'content' => $request->get('thought-content', ''),
        ]);

        return redirect()->route('dashboard')->with('success', 'Thought Created Successfuly!');
    }

    public function destroy($id)
    {
        // Delete content
        Thought::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('dashboard')->with('success', 'Thought Deleted Successfuly!');
    }
}
