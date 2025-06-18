@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="page-header d-print-none mt-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Profile
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}"
                                        required>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">City</label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ old('city', $user->city) }}" required>
                                </div>
                            </div>                           
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Address</label>
                            <textarea class="form-control" name="address"
                                required>{{ old('address', $user->address) }}</textarea>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Occupation</label>
                                    <input type="text" class="form-control" name="occupation"
                                        value="{{ old('occupation', $user->occupation) }}" required>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Country</label>
                                    <input type="text" class="form-control" name="country"
                                        value="{{ old('country', $user->country) }}" required>
                                </div>
                            </div>                               
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i>
                                Save Changes
                            </button>
                            <a href="{{ route('user.show') }}" class="btn btn-outline-secondary ms-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection