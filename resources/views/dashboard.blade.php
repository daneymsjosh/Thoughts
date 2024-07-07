@extends('layout.base')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.submit-thought')
            <hr>
            @foreach ($thoughts as $thought)
                <div class="mt-3">
                    @include('shared.thought-card')
                </div>
            @endforeach
            <div class="mt-3">
                {{ $thoughts->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
