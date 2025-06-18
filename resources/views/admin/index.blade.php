@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>User Management</h2>

        <!-- Search and Per Page -->
        <form method="GET" action="{{ route('admin.index') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Search users...">
            </div>
            <div class="col-md-2">
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </form>

        <!-- Table -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th><a href="?sort=first_name&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">First
                                    Name</a></th>
                            <th><a href="?sort=last_name&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">Last
                                    Name</a></th>
                            <th><a
                                    href="?sort=email&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}">Email</a>
                            </th>
                            <th>Date of Birth</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->date_of_birth }}</td>
                                <td>
                                    @php
                                        $badgeClass = match ($user->status) {
                                            'Active' => 'success',
                                            'Inactive' => 'danger',
                                            'Suspended' => 'warning',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">{{ $user->status }}</span>
                                </td>


                                <td>
                                    <a href="{{ route('admin.show', $user->id) }}" class="btn btn-info btn-sm">
                                        <i class="ti ti-eye"></i> View
                                    </a>

                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection