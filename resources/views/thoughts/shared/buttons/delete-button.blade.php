<form action="{{ route('thoughts.destroy', $thought->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="ms-1 btn btn-danger btn-sm"><span class="fas fa-trash">
        </span></button>
</form>
