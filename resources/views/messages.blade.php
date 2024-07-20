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
            <div class="rounded border border-gray d-flex align-items-center justify-content-center"
                style="height: calc(100vh - 20px);">
                <h4 class="text-center">Choose a conversation to start</h4>
            </div>
        </div>
        <div class="col-3">
            <div class="rounded border border-gray align-items-center" style="height: calc(100vh - 20px);">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="GET" class="d-flex w-100">
                            <input placeholder="Search Messages" class="form-control w-100" type="text" name="search">
                            <button type="submit" class="btn btn-dark"><span class="fas fa-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack gap-2">
                                <div>
                                    <a href="#">
                                        <img style="width:60px; height:60px; object-fit:cover;"
                                            class="avatar-img rounded-circle"
                                            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                            alt="Mario Avatar"></a>
                                </div>
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0" href="#">Username</a>
                                    <p class="mb-0 small text-truncate">July 20, 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="hstack gap-2">
                                <div>
                                    <a href="#">
                                        <img style="width:60px; height:60px; object-fit:cover;"
                                            class="avatar-img rounded-circle"
                                            src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario"
                                            alt="Mario Avatar"></a>
                                </div>
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0" href="#">Username</a>
                                    <p class="mb-0 small text-truncate">July 20, 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
