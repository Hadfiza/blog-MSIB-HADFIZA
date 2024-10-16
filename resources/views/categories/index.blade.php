@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>

    {{-- Menampilkan tombol buat kategori hanya untuk user yang login --}}
    @if (auth()->check())
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Create Category</a>
    @endif

    <div class="list-group">
        @if (count($categories) > 0)
            @foreach ($categories as $category)
                <div class="list-group-item justify-content-between align-items-center d-flex">
                    <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                    <div>
                        {{-- Menampilkan tombol edit dan delete hanya untuk user yang login --}}
                        @if (auth()->check())
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this data?');">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="list-group-item justify-content-between align-items-center">
                No data
            </div>
        @endif
    </div>
@endsection
