@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

@php
    $today = now()->format('m-d');
    $userBirthday = $user->date_of_birth ? $user->date_of_birth->format('m-d') : null;
@endphp

<div class="page-header d-print-none mt-4">
    
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Account Management
                </div>
                <h2 class="page-title">
                    My Profile
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('user.edit') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                            <path d="M16 5l3 3"/>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <!-- Profile Card -->
            <div class="col-12">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Image & Basic Info -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <span class="avatar avatar-xl avatar-rounded border border-3 border-white shadow-lg" 
                                              style="background-image: url(https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=identicon&s=200)"></span>
                                    </div>
                                    <h3 class="m-0 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h3>
                                    <div class="text-muted mb-3">{{ $user->occupation }}</div>
                                    
                                    <div class="mb-4">
                                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }} badge-pill fs-6 px-3 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="9"/>
                                                <path d="M9 12l2 2l4 -4"/>
                                            </svg>
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </div>

                                    <!-- Quick Stats -->
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="h4 m-0">
    {{ $user->age ? ($user->age === '< 1' ? 'Less than 1 year' : $user->age . ' years') : 'Not specified' }}
</div>

                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Profile Details -->
                            <div class="col-md-8">
                                <div class="card-title h4 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="12" r="3"/>
                                        <path d="M12 1v6m0 6v6"/>
                                        <path d="M21 12h-6m-6 0h-6"/>
                                    </svg>
                                    Personal Information
                                </div>
                                
                                <!-- Contact Information -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <circle cx="12" cy="12" r="4"/>
                                                    <path d="M16 8v5a3 3 0 0 0 6 0v-5a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v5a3 3 0 0 0 6 0v-5"/>
                                                </svg>
                                                Email Address
                                            </label>
                                            <div class="fw-medium">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                                </svg>
                                                Phone Number
                                            </label>
                                            <div class="fw-medium">{{ $user->phone ?? 'Not provided' }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Birth Date -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <rect x="4" y="5" width="16" height="16" rx="2"/>
                                                    <line x1="16" y1="3" x2="16" y2="7"/>
                                                    <line x1="8" y1="3" x2="8" y2="7"/>
                                                    <line x1="4" y1="11" x2="20" y2="11"/>
                                                </svg>
                                                Date of Birth
                                            </label>
                                            <div class="fw-medium">{{ $user->date_of_birth ? $user->date_of_birth->format('M d, Y') : 'Not provided' }}</div>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                <!-- Address Information -->
                                <hr class="my-4">
                                <div class="card-title h5 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="11" r="3"/>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"/>
                                    </svg>
                                    Address Information
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-medium">Street Address</label>
                                    <div class="fw-medium">{{ $user->address }}</div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">City</label>
                                            <div class="fw-medium">{{ $user->city }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">Country</label>
                                            <div class="fw-medium">{{ $user->country }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Professional Information -->
                                <hr class="my-4">
                                <div class="card-title h5 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"/>
                                        <line x1="12" y1="12" x2="12" y2="12.01"/>
                                        <path d="M3 13a20 20 0 0 0 18 0"/>
                                    </svg>
                                    Professional Details
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">Occupation</label>
                                            <div class="fw-medium">{{ $user->occupation }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-muted small fw-medium">Company</label>
                                            <div class="fw-medium">{{ $user->company ?? 'Not provided' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('users.export.csv') }}" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h6l6 6v10a2 2 0 0 1 -2 2z"/>
                                        <path d="M12 17v-6"/>
                                        <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"/>
                                    </svg>
                                    Export CSV
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        

    </div>
    
</div>
@if($userBirthday === $today)
    <div id="birthday-wish" style="position: fixed; top: 1rem; right: 1rem; z-index: 1050; background: #d4edda; border: 1px solid #c3e6cb; padding: 1rem 1.5rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 300px; font-weight: 600;">
        🎂 Happy Birthday, {{ $user->first_name }}!<br>
        May your year be filled with happiness and success.
        <button onclick="document.getElementById('birthday-wish').remove()" style="border:none; background:none; font-weight:bold; cursor:pointer; float:right;">&times;</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        confetti({
            particleCount: 150,
            spread: 70,
            origin: { y: 0.6 }
        });
        setTimeout(() => {
            confetti({
                particleCount: 150,
                spread: 70,
                origin: { y: 0.6 }
            });
        }, 3000);
    </script>
@endif

<style>
.avatar {
    transition: transform 0.2s ease;
}

.avatar:hover {
    transform: scale(1.05);
}

.card {
    transition: box-shadow 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 8px;
    border-left: 3px solid var(--tblr-primary);
}

.badge-pill {
    border-radius: 50px;
}

.card-title {
    color: var(--tblr-dark);
    border-bottom: 2px solid var(--tblr-border-color);
    padding-bottom: 0.5rem;
}

.text-center .row .col-6 {
    padding: 1rem 0.5rem;
    border-radius: 8px;
    margin: 0.25rem 0;
    background: rgba(var(--tblr-primary-rgb), 0.1);
}
</style>
@endsection