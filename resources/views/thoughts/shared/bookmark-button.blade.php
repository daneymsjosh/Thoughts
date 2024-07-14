<div>
    @auth
        @if (Auth::user()->pinned($thought))
            <form action="{{ route('thoughts.unpin', $thought->id) }}" method="post">
                @csrf
                <button class="ms-1 btn btn-success btn-sm fas fa-bookmark me-2"></button>
            </form>
        @else
            <form action="{{ route('thoughts.pin', $thought->id) }}" method="post">
                @csrf
                <button class="ms-1 btn btn-success btn-sm far fa-bookmark me-2"></button>
            </form>
        @endif
    @endauth
</div>
