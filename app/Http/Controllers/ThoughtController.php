<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        $thought = Thought::create([
            'content' => $request->get('thought-content', ''),
        ]);

        return redirect()->route('dashboard');
    }
}
