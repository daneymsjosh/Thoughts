<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-light" href="{{ route('dashboard') }}"><span class="fas fa-lightbulb me-2">
            </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    @if (Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">Admin
                                Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('profile') ? 'active' : '' }}"
                            href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-1">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
