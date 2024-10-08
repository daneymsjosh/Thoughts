<?php

namespace App\Providers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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

        $topUsers = Cache::remember('topUsers', now()->addMinute(), function () {
            return User::withCount('thoughts')->orderBy('thoughts_count', 'DESC')->limit(5)->get();
        });

        // Add a global variable for our views
        View::share('topUsers', $topUsers);

        // Change to filipino language
        // App::setLocale('fil');

        // Role
        Gate::define('admin', function (User $user) {
            return (bool) $user->is_admin;
        });

        // If I want to use Gates instead of Policies
        // Permission
        // Gate::define('thought.delete', function (User $user, Thought $thought) {
        //     return ((bool) $user->is_admin || $user->id === $thought->user_id);
        // });

        // Gate::define('thought.edit', function (User $user, Thought $thought) {
        //     return ((bool) $user->is_admin || $user->id === $thought->user_id);
        // });
    }
}
