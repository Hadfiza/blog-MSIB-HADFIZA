@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p><strong>Category:</strong> {{ $post->category->name }}</p>
    <p><strong>Content:</strong> {{ $post->content }}</p>
    @if ($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" alt="Post image" class="img-thumbnail" style="width: 100%; height: auto;">
    @endif
    <p>
        <strong>Status:</strong>
        <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}">
            {{ $post->is_published ? 'Published' : 'Draft' }}
        </span>
    </p>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back</a>
@endsection
