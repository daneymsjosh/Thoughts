<?php

namespace App\Policies;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ThoughtPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Thought $thought): bool
    {
        // edit/update
        return ($user->is_admin || $user->is($thought->user));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Thought $thought): bool
    {
        // destroy
        return ($user->is_admin || $user->is($thought->user));
    }
}
