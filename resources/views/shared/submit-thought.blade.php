<h4> Share your thoughts </h4>
<div class="row">
    <form action="{{ route('thought.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="thought-content" class="form-control" id="thought" rows="3"></textarea>
            @error('thought-content')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="">
            <button class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
