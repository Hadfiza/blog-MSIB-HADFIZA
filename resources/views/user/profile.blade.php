@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <h1>User Profile</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>
        {{-- <button type="submit" class="btn btn-primary mt-2">Update Profile</button> --}}
    </form>

    {{-- <p class="mt-4"><strong>Email:</strong> {{ $user->email }}</p> --}}
@endsection
