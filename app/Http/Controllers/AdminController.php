<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the users (excluding Admins).
     */
    public function index(Request $request)
    {
        $query = User::query()->where('role', '!=', 'Admin');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $query->orderBy(
            $request->get('sort', 'id'),
            $request->get('direction', 'asc')
        );

        $users = $query->paginate($request->get('per_page', 10));

        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'phone'          => 'nullable|string|max:20',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:100',
            'country'        => 'nullable|string|max:100',
            'occupation'     => 'nullable|string|max:100',
            'status'         => ['required', Rule::in(['Active', 'Inactive', 'Suspended'])],
            'password'       => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'User'; // Always assign 'User' role when creating

        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::where('role', '!=', 'Admin')->findOrFail($id);
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::where('role', '!=', 'Admin')->findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified user in storage (role not editable).
     */
    public function update(Request $request, $id)
    {
        $user = User::where('role', '!=', 'Admin')->findOrFail($id);

        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone'          => 'nullable|string|max:20',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:100',
            'country'        => 'nullable|string|max:100',
            'occupation'     => 'nullable|string|max:100',
            'status'         => ['required', Rule::in(['Active', 'Inactive', 'Suspended'])],
            'password'       => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::where('role', '!=', 'Admin')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
