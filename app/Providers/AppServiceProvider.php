<?php

namespace App\Providers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Uses bootstrap 5 to paginate
        Paginator::useBootstrapFive();

        // Role
        Gate::define('admin', function (User $user) {
            return (bool) $user->is_admin;
        });

        // Permission
        Gate::define('thought.delete', function (User $user, Thought $thought) {
            return ((bool) $user->is_admin || $user->id === $thought->user_id);
        });

        Gate::define('thought.edit', function (User $user, Thought $thought) {
            return ((bool) $user->is_admin || $user->id === $thought->user_id);
        });
    }
}
