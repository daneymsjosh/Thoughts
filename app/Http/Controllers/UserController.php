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
        $featuredThought = $user->thoughts()->where('featured', true)->first();

        $thoughts = $user->thoughts()->paginate(5);

        $likedIds = auth()->user()->likes()->pluck('id');
        $likedThoughts = Thought::likedThought(auth()->user())->paginate(5);

        $medias = Thought::media(auth()->user())->get();

        return view('users.show', compact('user', 'thoughts', 'featuredThought', 'likedThoughts', 'medias'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $editing = true;

        $featuredThought = $user->thoughts()->where('featured', true)->first();

        $thoughts = $user->thoughts()->paginate(5);

        $likedIds = auth()->user()->likes()->pluck('id');
        $likedThoughts = Thought::likedThought(auth()->user())->paginate(5);

        $medias = Thought::media(auth()->user())->get();

        return view('users.edit', compact('user', 'editing', 'thoughts', 'featuredThought', 'likedThoughts', 'medias'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();

        $validated['is_admin'] = $request->has('is_admin');

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
