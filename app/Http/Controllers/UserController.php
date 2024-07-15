<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function show(User $user)
    {
        $thoughts = $user->thoughts()->paginate(5);

        $likedIds = auth()->user()->likes()->pluck('id');
        $likedThoughts = Thought::whereIn('id', $likedIds)->latest()->paginate(5);


        return view('users.show', compact('user', 'thoughts', 'likedThoughts'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $editing = true;

        $thoughts = $user->thoughts()->paginate(5);

        $likedIds = auth()->user()->likes()->pluck('id');
        $likedThoughts = Thought::whereIn('id', $likedIds)->latest()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'thoughts', 'likedThoughts'));
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
