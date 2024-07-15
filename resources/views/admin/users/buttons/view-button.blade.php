@if ($viewing ?? false)
@else
    <form action="{{ route('users.show', $user->id) }}" method="get">
        @csrf
        <button class="mx-1 btn btn-success btn-sm"><span class="fas fa-eye">
            </span></button>
    </form>
@endif
