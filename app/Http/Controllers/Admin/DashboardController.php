<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalThoughts = Thought::count();
        $totalComments = Comment::count();

        return view('admin.dashboard', compact('totalUsers', 'totalThoughts', 'totalComments'));
    }
}
