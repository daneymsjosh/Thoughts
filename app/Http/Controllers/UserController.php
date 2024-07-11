<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user)
    {
        $thoughts = $user->thoughts()->paginate(5);

        return view('users.show', compact('user', 'thoughts'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $editing = true;

        $thoughts = $user->thoughts()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'thoughts'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
