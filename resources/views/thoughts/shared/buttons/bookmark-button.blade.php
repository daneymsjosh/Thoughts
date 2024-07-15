<div>
    @auth
        @if (Auth::user()->pinned($thought))
            <form action="{{ route('thoughts.unpin', $thought->id) }}" method="post">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-bookmark me-1">
                    </span> {{ $thought->pins_count }} </button>
            </form>
        @else
            <form action="{{ route('thoughts.pin', $thought->id) }}" method="post">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-bookmark me-1">
                    </span> {{ $thought->pins_count }} </button>
            </form>
        @endif
    @endauth
</div>
