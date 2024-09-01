@extends('layout.base')

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Notifications</h1>
            <hr>
            <div class="rounded border border-gray" style="height: calc(100vh - 120px); overflow-y: auto;">
                @forelse ($notifications as $notification)
                    @php
                        $notificationData = json_decode($notification->data);
                        $notificationType = $notification->type;
                        $url = route('notifications.markAsRead', $notification->id);
                    @endphp

                    <a href="{{ $url }}" class="text-decoration-none text-dark">
                        <div class="notification-item p-3 mb-2 rounded"
                            style="background-color: {{ $notification->is_read ? '#f8f9fa' : '#e9ecef' }}; border: 1px solid #e3e6ea;">
                            <div class="d-flex justify-content-between align-items-center">
                                @switch($notificationType)
                                    @case('like')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->liked_by }} liked your post</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @case('unlike')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->unliked_by }} unliked your post</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @case('comment')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->commented_by }} commented on your post</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @case('follow')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->followed_by }} followed you</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @case('unfollow')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->unfollowed_by }} unfollowed you</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @case('message')
                                        <div>
                                            <p class="mb-0">{{ $notificationData->sent_by }} sent you a message</p>
                                        </div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @break

                                    @default
                                        <p class="mb-0">You have a new notification</p>
                                @endswitch
                            </div>
                        </div>
                    </a>
                    @empty
                        <p class="text-center">No Notifications</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endsection
