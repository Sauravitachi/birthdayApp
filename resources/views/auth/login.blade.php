@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="card-title text-center mb-4">Login to your account</h2>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" name="remember">
                <span class="form-check-label">Remember me</span>
            </label>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
        @if (Route::has('password.request'))
            <div class="text-center text-muted mt-3">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif
    </form>

    <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
    </div>
@endsection