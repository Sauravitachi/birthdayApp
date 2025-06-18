@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2 class="card-title text-center mb-4">Create new account</h2>

        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input id="first_name" name="first_name" type="text"
                class="form-control @error('first_name') is-invalid @enderror"
                value="{{ old('first_name') }}" required autofocus autocomplete="given-name">
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input id="last_name" name="last_name" type="text"
                class="form-control @error('last_name') is-invalid @enderror"
                value="{{ old('last_name') }}" required autocomplete="family-name">
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password"
                class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="form-control" required autocomplete="new-password">
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </div>

        <div class="text-center text-muted mt-3">
            Already registered? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </form>
@endsection
