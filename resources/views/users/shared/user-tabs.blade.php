<ul class="nav nav-tabs" style="justify-content:space-around" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" data-bs-toggle="tab" href="#thoughts-tab" aria-selected="true" role="tab">Thoughts</a>
    </li>
    @if (Auth::id() === $user->id)
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#likes-tab" aria-selected="false" tabindex="-1"
                role="tab">Likes</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#media-tab" aria-selected="false" tabindex="-1"
                role="tab">Media</a>
        </li>
    @endif
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active" id="thoughts-tab" role="tabpanel">
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
    <div class="tab-pane fade" id="likes-tab" role="tabpanel">
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
    <div class="tab-pane fade" id="media-tab" role="tabpanel">
        <div class="border border-bottom-0 rounded mt-3">
            <div class="row" style="margin: 0;">
                @forelse ($medias as $media)
                    <div class="col-12 col-sm-6 col-md-4" style="padding: 0;">
                        <img style="width: 230px; height: 230px; object-fit: cover; border:1px solid #D2D2D2"
                            class="img-fluid rounded" src="{{ $media->getImageURL() }}" alt="">
                    </div>
                @empty
                    <p class="text-center mt-4">No Media Found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
