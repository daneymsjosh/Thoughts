<div class="card">
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
                    <a href="{{ route('users.edit', $user->id) }}">Edit Profile</a>
                </div>
            @endcan
        @endauth
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center" style="margin-top: 60px;">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
            {{ $user->bio }}
            </p>
            @include('users.shared.user-stats')
            @auth
                @if (Auth::user()->isNot($user))
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                            <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                            </form>
                        @endif

                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
