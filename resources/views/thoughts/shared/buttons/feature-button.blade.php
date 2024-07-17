@if ($featuredThought && $thought->id === $featuredThought->id)
    <form action="{{ route('thoughts.unfeature', $thought) }}" method="post">
        @csrf
        <button class="mx-1 btn btn-warning btn-sm"><span class="fas fa-star"></span></button>
    </form>
@else
    <form action="{{ route('thoughts.feature', $thought) }}" method="post">
        @csrf
        <button class="mx-1 btn btn-warning btn-sm"><span class="far fa-star"></span></button>
    </form>
@endif
