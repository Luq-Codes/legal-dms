<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Auditlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    public function create()
{
    return view('admin.users.create');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,lawyer,staff,client',
          ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
          ]);

        AuditLog::record(
            'User Created',
            'Users',
            'Created user ' . $user->name . ' with role ' . $user->role . '.'
        );

      return redirect()->route('admin.users.index')
        ->with('success', 'User created successfully.');
}

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,lawyer,staff,client',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $oldRole = $user->role;
        $oldEmail = $user->email;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        AuditLog::record(
            'User Updated',
            'Users',
            'Updated user ' . $user->name . '. Role changed from ' . $oldRole . ' to ' . $user->role . '. Email changed from ' . $oldEmail . ' to ' . $user->email . '.'
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
}
