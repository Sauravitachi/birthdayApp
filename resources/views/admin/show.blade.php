@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Details</h3>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm float-end">Back</a>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">First Name</dt>
                <dd class="col-sm-9">{{ $user->first_name }}</dd>

                <dt class="col-sm-3">Last Name</dt>
                <dd class="col-sm-9">{{ $user->last_name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $user->phone ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Date of Birth</dt>
                <dd class="col-sm-9">{{ $user->date_of_birth ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $user->address ?? 'N/A' }}</dd>

                <dt class="col-sm-3">City</dt>
                <dd class="col-sm-9">{{ $user->city ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Country</dt>
                <dd class="col-sm-9">{{ $user->country ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Occupation</dt>
                <dd class="col-sm-9">{{ $user->occupation ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><span class="badge bg-{{ $user->status === 'Active' ? 'success' : 'secondary' }}">{{ $user->status }}</span></dd>
            </dl>
        </div>
    </div>
</div>
@endsection
