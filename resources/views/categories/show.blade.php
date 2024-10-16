@extends('layouts.app')

@section('title', 'Category Detail')

@section('content')
    <h1>Category Detail</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary mb-3">Back</a>

    <div class="card">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Description: </strong>{{ $category->description }}</p>
        </div>
    </div>
@endsection
