@extends('layouts.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark">
                <h2 class="h2">BirthdayApp</h2>
            </a>
        </div>
        
        <div class="card card-md">
            <div class="card-body">
                @if (session('reset_link'))
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="ti ti-mail-check icon-lg text-success mb-3"></i>
                            <h2 class="h2">Reset Link Sent</h2>
                            <p class="text-muted">
                                Check your email for the password reset link.
                                <span class="d-block text-muted small mt-2">(Simulated for demo)</span>
                            </p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ session('reset_link') }}" class="btn btn-primary w-100">
                                <i class="ti ti-key me-2"></i>
                                Go to Password Reset Page
                            </a>
                        </div>
                    </div>
                @else
                    <h2 class="h2 text-center mb-4">Forgot Password</h2>
                    <p class="text-muted text-center mb-4">Enter your email to receive a password reset link</p>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="ti ti-circle-check icon"></i>
                                    {{ session('status') }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" autocomplete="off" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       placeholder="your@email.com"
                                       value="{{ old('email') }}"
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-mail-forward me-2"></i>
                                Send Reset Link
                            </button>
                        </div>
                    </form>
                @endif
            </div>
            
            @unless (session('reset_link'))
                <div class="hr-text">or</div>
                <div class="card-body">
                    <div class="text-center text-muted mt-3">
                        Remember your password? 
                        <a href="{{ route('login') }}" tabindex="-1">
                            Sign in
                        </a>
                    </div>
                </div>
            @endunless
        </div>
    </div>
</div>
@endsection