<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|regex:/^[a-zA-Z0-9._]+$/|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
            'is_active' => 'boolean',
        ]);

        // Prevent creating super admin unless you are super admin
        $role = Role::findOrFail($validated['role_id']);
        if ($role->slug === 'super-admin' && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Only super admins can create super admin accounts.');
        }

        User::create([
            'name'      => $validated['name'],
            'username'  => strtolower($validated['username']),
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role_id'   => $validated['role_id'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._]+$/', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
            'is_active' => 'boolean',
        ]);

        // Prevent changing own role or deactivating self
        if ($user->id === auth()->id()) {
            $validated['role_id'] = $user->role_id;
            $validated['is_active'] = true;
        }

        $user->update([
            'name'      => $validated['name'],
            'username'  => strtolower($validated['username']),
            'email'     => $validated['email'],
            'role_id'   => $validated['role_id'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Reset a user's password to a randomly generated temporary password.
     */
    public function resetPassword(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Use the Change Password page to update your own password.');
        }

        $tempPassword = Str::random(12);

        $user->update([
            'password' => Hash::make($tempPassword),
        ]);

        return back()->with('success', "Password for {$user->name} has been reset to: {$tempPassword} — Please share it securely with the user.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
