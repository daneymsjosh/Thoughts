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
