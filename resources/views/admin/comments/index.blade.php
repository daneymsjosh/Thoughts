@extends('layout.base')

@section('title', 'Comments | Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Comments</h1>
            @include('shared.success-message')
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Thought</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>
                                <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('thoughts.show', $comment->thought) }}">{{ $comment->thought->id }}</a>
                            </td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->created_at->toDateString() }}</td>
                            <td class="d-flex">
                                @include('admin.comments.buttons.delete-button')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
