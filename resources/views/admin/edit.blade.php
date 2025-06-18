@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm float-end">Back</a>
            </div>

            <div class="card-body">
                @foreach (['first_name', 'last_name', 'email', 'phone', 'date_of_birth', 'address', 'city', 'country', 'occupation'] as $field)
                    <div class="mb-3">
                        <label class="form-label text-capitalize">{{ str_replace('_', ' ', $field) }}</label>
                        <input type="{{ $field === 'date_of_birth' ? 'date' : 'text' }}" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field, $user->$field) }}">
                        @error($field)
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['Active', 'Inactive', 'Suspended'] as $status)
                            <option value="{{ $status }}" {{ old('status', $user->status) === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password <small>(leave blank to keep current)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </div>
    </form>
</div>
@endsection
