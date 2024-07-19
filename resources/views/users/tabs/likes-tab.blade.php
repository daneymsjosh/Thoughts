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
