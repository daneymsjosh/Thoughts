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
