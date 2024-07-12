<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function index()
    {
        $thoughts = Thought::latest()->paginate(5);

        return view('admin.thoughts.index', compact('thoughts'));
    }
}
