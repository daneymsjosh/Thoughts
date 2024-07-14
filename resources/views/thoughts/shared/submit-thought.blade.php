@auth
    <h4> Share your thoughts </h4>
    <div class="row">
        <form enctype="multipart/form-data" action="{{ route('thoughts.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
                <input name="image" type="file" class="form-control">
                @error('image')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4> @lang('thoughts.login_to_share') </h4>
@endguest
