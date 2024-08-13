@extends('layout.base')

@section('title', 'Messages')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Conversations</h1>
            <hr>
            <div class="rounded border border-gray" style="height: calc(100vh - 120px);">
                @if (isset($conversation))
                    <!-- Display messages of the selected conversation -->
                    <div class="p-3" style="height: calc(100vh - 260px); overflow-y: auto;">
                        {{-- Display messages here --}}
                        @foreach ($messages as $message)
                            @if ($message->sender_id === Auth::id())
                                <div class="mb-2 text-end">
                                    {{ $message->message }} :
                                    <strong><a href="#" style="text-decoration: none;">
                                            {{ $message->sender->name }}
                                            <img style="width:60px; height:60px; object-fit:cover; "
                                                class="avatar-img rounded-circle"
                                                src="{{ $message->sender->getImageURL() }}" alt="">
                                        </a></strong>
                                    <small class="text-muted d-block">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            @else
                                <div class="mb-2 text-start">
                                    <strong><a href="#" style="text-decoration: none;">
                                            <img style="width:60px; height:60px; object-fit:cover; "
                                                class="avatar-img rounded-circle"
                                                src="{{ $message->sender->getImageURL() }}" alt="">
                                            {{ $message->sender->name }}
                                        </a></strong>: {{ $message->message }}
                                    <small class="text-muted d-block">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- Message input -->
                    <div class="p-3 border-top">
                        <form action="{{ route('messages.store', $conversation->id) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" placeholder="Type a message"
                                    required>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Default message when no conversation is selected -->
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h4 class="text-center">Choose a conversation to start</h4>
                    </div>
                @endif
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
                    @if (isset($followings))
                        @forelse ($followings as $following)
                            <div class="card">
                                <div class="card-body">
                                    <div class="hstack gap-2">
                                        <div>
                                            <a href="{{ route('conversations.create', $following->id) }}">
                                                <img style="width:60px; height:60px; object-fit:cover;"
                                                    class="avatar-img rounded-circle" src="{{ $following->getImageUrl() }}"
                                                    alt="{{ $following->name }}">
                                            </a>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a class="h6 mb-0"
                                                href="{{ route('conversations.create', $following->id) }}">{{ $following->name }}</a>
                                            <p class="mb-0 small text-truncate">
                                                {{ $following->created_at->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Followings</p>
                        @endforelse
                    @else
                        @forelse ($conversations as $conversation)
                            @if ($conversation->user_id1 === Auth::id())
                                <div class="card">
                                    <div class="card-body">
                                        <div class="hstack gap-2">
                                            <div>
                                                <a href="{{ route('conversations.show', $conversation->id) }}">
                                                    <img style="width:60px; height:60px; object-fit:cover;"
                                                        class="avatar-img rounded-circle"
                                                        src="{{ $conversation->user2->getImageUrl() }}"
                                                        alt="{{ $conversation->user2->name }}">
                                                </a>
                                            </div>
                                            <div class="overflow-hidden">
                                                <a class="h6 mb-0"
                                                    style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: calc(1.5em * 2); line-height: 1.5em; text-decoration: none"
                                                    href="{{ route('conversations.show', $conversation->id) }}">{{ $conversation->user2->name }}:
                                                    {{ $conversation->lastMessage ? $conversation->lastMessage->message : '' }}
                                                </a>
                                                <p class="mb-0 small text-truncate">
                                                    {{ $conversation->created_at->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <div class="hstack gap-2">
                                            <div>
                                                <a href="{{ route('conversations.show', $conversation->id) }}">
                                                    <img style="width:60px; height:60px; object-fit:cover;"
                                                        class="avatar-img rounded-circle"
                                                        src="{{ $conversation->user1->getImageUrl() }}"
                                                        alt="{{ $conversation->user1->name }}">
                                                </a>
                                            </div>
                                            <div class="overflow-hidden">
                                                <a class="h6 mb-0"
                                                    style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: calc(1.5em * 2); line-height: 1.5em; text-decoration: none"
                                                    href="{{ route('conversations.show', $conversation->id) }}">{{ $conversation->user1->name }}:
                                                    {{ $conversation->lastMessage ? $conversation->lastMessage->message : '' }}
                                                </a>
                                                <p class="mb-0 small text-truncate">
                                                    {{ $conversation->created_at->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p>No Conversations</p>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
