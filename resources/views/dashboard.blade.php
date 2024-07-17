@extends('layout.base')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('thoughts.shared.submit-thought')
            <hr>
            @forelse ($thoughts as $thought)
                <div class="mt-3">
                    @include('thoughts.shared.thought-card', [
                        'thought' => $thought,
                        'featuredThought' => $featuredThought,
                    ])
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
