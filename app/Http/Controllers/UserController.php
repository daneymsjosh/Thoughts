<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $thoughts = $user->thoughts()->paginate(5);

        return view('users.show', compact('user', 'thoughts'));
    }

    public function edit(User $user)
    {
        $editing = true;

        $thoughts = $user->thoughts()->paginate(5);

        return view('users.show', compact('user', 'editing', 'thoughts'));
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
