@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    @if (now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New!</div>
    @endif

    <div>
        <h4>Comments</h4>

        @forelse ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            <p class="text-muted">Added {{ $comment->created_at->diffForHumans() }}</p>
        @empty
            <p>No Comments Yet!</p>
        @endforelse
    </div>
@endsection
