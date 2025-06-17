@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Users</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <form action="{{ route('users.export') }}" method="POST" class="me-2">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Export CSV
                        </button>
                    </form>
                    @if(auth()->user()->role === 'Admin')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            Add User
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
            </div>
            <div class="card-body border-bottom py-3">
                <form method="GET" action="{{ route('users.index') }}">
                    <div class="d-flex">
                        <div class="me-3">
                            <input type="text" name="search" class="form-control" placeholder="Search..." 
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>@sortablelink('id', 'ID')</th>
                            <th>@sortablelink('first_name', 'First Name')</th>
                            <th>@sortablelink('last_name', 'Last Name')</th>
                            <th>@sortablelink('email', 'Email')</th>
                            <th>@sortablelink('date_of_birth', 'Birthday')</th>
                            <th>@sortablelink('status', 'Status')</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->date_of_birth->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->status === 'Active' ? 'success' : ($user->status === 'Inactive' ? 'warning' : 'danger') }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                    @if(auth()->user()->role === 'Admin')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</p>
                <ul class="pagination m-0 ms-auto">
                    {{ $users->appends(request()->query())->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection