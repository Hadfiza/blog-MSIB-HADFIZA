@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-3">Back</a>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}">
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control">{{ old('content', $post->content) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" class="form-control">
                <option value="">Choose</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" class="form-control">
            @if ($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="Post image" class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
            @endif
        </div>
        
        <!-- Hidden input to ensure is_published is always sent -->
        <input type="hidden" name="is_published" value="0"> <!-- Ini memastikan jika checkbox tidak dicentang, nilainya 0 -->
        <div class="form-check">
            <input type="checkbox" name="is_published" class="form-check-input" {{ $post->is_published ? 'checked' : '' }}>
            <label for="isPublished" class="form-check-label">Publish</label>
        </div>
        
        
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
@endsection
