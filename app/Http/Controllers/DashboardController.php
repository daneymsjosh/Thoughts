<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $thoughts = Thought::when($request->has('search'), function ($query) {
            $query->search(request('search', ''));
        })->orderBy('created_at', 'DESC')->paginate(5);

        $featuredThought = $user ? $user->thoughts()->where('featured', true)->first() : null;

        return view('dashboard', [
            'thoughts' => $thoughts,
            'featuredThought' => $featuredThought
        ]);
    }
}
