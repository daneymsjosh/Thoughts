<div class="card">
    <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('put')
        <div style="position: relative; height: 250px;">
            <img src="{{ $user->getCoverImageURL() }}" alt="{{ $user->name }}" class="rounded-top"
                style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; bottom: -75px; left: 20px;">
                <img src="{{ $user->getImageURL() }}" alt="{{ $user->name }}"
                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid white; border-radius: 50%;">
            </div>
        </div>
        <div class="px-3 pt-4 pb-2" style="position: relative; top: -10px">
            @auth
                @can('update', $user)
                    <div style="text-align: right;">
                        <a href="{{ route('users.show', $user->id) }}">View Profile</a>
                    </div>
                @endcan
            @endauth
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center" style="margin-top: 60px;">
                    <div>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_admin" id="flexSwitchCheckDefault"
                        value="1" {{ $user->is_admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
                </div>
            </div>
            <div class="mt-4">
                <label for="">Cover Photo</label>
                <input name="cover" type="file" class="form-control">
                @error('cover')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="">Profile Picture</label>
                <input name="image" type="file" class="form-control">
                @error('image')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <p class="fs-6 fw-light">
                <div class="mb-3">
                    <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                    @error('bio')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-dark btn-sm mb-3">Save</button>
                @include('users.shared.user-stats')
            </div>
    </form>
</div>
