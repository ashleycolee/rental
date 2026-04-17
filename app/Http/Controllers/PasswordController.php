<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        // karena DB lo pakai 'pass' bukan 'password'
        $user->pass = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diupdate');
    }
}