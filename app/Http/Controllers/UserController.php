<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $users = User::when($search, function ($query, $search) {
            return $query->where('username', 'like', "%{$search}%")
                ->orWhere('namalengkap', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'namalengkap' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'identitas' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:20',
            'role' => ['required', Rule::in(['user', 'admin', 'petugas'])],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['name'] = $validated['namalengkap']; 

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'namalengkap' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'identitas' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:20',
            'role' => ['required', Rule::in(['user', 'admin'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}

