<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $thoughts = Thought::orderBy('created_at', 'DESC');

        if ($request->has('search')) {
            $thoughts = $thoughts->where('content', 'like', '%' . $request->get('search', '') . '%');
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(5),
        ]);
    }
}
