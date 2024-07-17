<ul class="nav nav-tabs" style="justify-content:space-around" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active {{ Route::is('dashboard') ? 'active' : '' }}" data-bs-toggle="tab" href="#thoughts-tab"
            aria-selected="true" role="tab">Thoughts</a>
    </li>
    @if (Auth::id() === $user->id)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ Route::is('like') ? 'active' : '' }}" data-bs-toggle="tab" href="#likes-tab"
                aria-selected="false" tabindex="-1" role="tab">Likes</a>
        </li>
    @endif
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active {{ Route::is('dashboard') ? 'show active' : '' }}" id="thoughts-tab"
        role="tabpanel">
        @if ($featuredThought)
            <div class="mt-3">
                @include('thoughts.shared.thought-card', ['thought' => $featuredThought])
            </div>
        @endif
        @forelse ($thoughts as $thought)
            @if (!$featuredThought || $thought->id !== $featuredThought->id)
                <div class="mt-3">
                    @include('thoughts.shared.thought-card', ['thought' => $thought])
                </div>
            @endif
        @empty
            <p class="text-center mt-4">No Results Found.</p>
        @endforelse
        <div class="mt-3">
            {{ $thoughts->withQueryString()->links() }}
        </div>
    </div>
    <div class="tab-pane fade {{ Route::is('likes') ? 'show active' : '' }}" id="likes-tab" role="tabpanel">
        @forelse ($likedThoughts as $thought)
            <div class="mt-3">
                @include('thoughts.shared.thought-card')
            </div>
        @empty
            <p class="text-center mt-4">No Results Found.</p>
        @endforelse
        <div class="mt-3">
            {{ $likedThoughts->withQueryString()->links() }}
        </div>
    </div>
</div>
