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
        @include('users.tabs.thoughts-tab')
    </div>
    <div class="tab-pane fade" id="likes-tab" role="tabpanel">
        @include('users.tabs.likes-tab')
    </div>
    <div class="tab-pane fade" id="media-tab" role="tabpanel">
        @include('users.tabs.media-tab')
    </div>
</div>
