<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $thought->user->getImageURL() }}"
                    alt="{{ $thought->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $thought->user->id) }}">
                            {{ $thought->user->name }} </a></h5>
                </div>
            </div>
            <div class="d-flex">
                @include('thoughts.shared.buttons.view-button')
                @auth
                    @can('feature', $thought)
                        @include('thoughts.shared.buttons.feature-button')
                    @endcan
                    @can('update', $thought)
                        @include('thoughts.shared.buttons.edit-button')
                        @include('thoughts.shared.buttons.delete-button')
                    @endcan
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form enctype="multipart/form-data" action="{{ route('thoughts.update', $thought->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $thought->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <input name="image" type="file" class="form-control">
                    @error('image')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button class="btn btn-dark mb-2 btn-small"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $thought->content }}
            </p>
            <img style="width: 75%; border:1px solid #D2D2D2" class="me-2 mb-3 img-fluid rounded"
                src="{{ $thought->getImageURL() }}" alt="{{ $thought->image }}">
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <div class="me-4">
                    @include('thoughts.shared.buttons.like-button')
                </div>
                @include('thoughts.shared.buttons.bookmark-button')
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $thought->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('thoughts.shared.comments-box')
    </div>
</div>
