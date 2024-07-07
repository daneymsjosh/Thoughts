<h4> Share your thoughts </h4>
<div class="row">
    <form action="{{ route('thought.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="thought-content" class="form-control" id="thought" rows="3"></textarea>
        </div>
        <div class="">
            <button class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
