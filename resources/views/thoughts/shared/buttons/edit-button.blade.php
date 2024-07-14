@if ($editing ?? false)
@else
    <form action="{{ route('thoughts.edit', $thought->id) }}" method="get">
        @csrf
        <button class="mx-1 btn btn-info btn-sm"><span class="fas fa-pen">
            </span></button>
    </form>
@endif
