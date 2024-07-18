@extends('layout.base')

@section('title', 'Messages')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Messages</h1>
            <hr>
        </div>
    </div>
@endsection
