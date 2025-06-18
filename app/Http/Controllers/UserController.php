<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'marital_status' => 'nullable|in:single,married,divorced',
        ]);

        $user->update($validated);

        return redirect()->route('user.show')
            ->with('success', 'Profile updated successfully!');
    }
}