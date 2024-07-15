<div>
    @auth
        @if (Auth::user()->liked($thought))
            <form action="{{ route('thoughts.unlike', $thought->id) }}" method="post">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $thought->likes_count }} </button>
            </form>
        @else
            <form action="{{ route('thoughts.like', $thought->id) }}" method="post">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                    </span> {{ $thought->likes_count }} </button>
            </form>
        @endif
    @endauth
    @guest
        <a href="{{ route('login') }}" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
            </span> {{ $thought->likes_count }} </a>
    @endguest
</div>
