@extends('layout.base')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            <div class="mt-3">
                @include('shared.user-card')
            </div>
            <hr>
            @forelse ($thoughts as $thought)
                <div class="mt-3">
                    @include('shared.thought-card')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p>
            @endforelse
            <div class="mt-3">
                {{ $thoughts->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection