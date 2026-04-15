<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with(['alat.kategori', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('idpinjam', 'like', "%{$search}%")
                    ->orWhereHas('alat', function ($q) use ($search) {
                        $q->where('namaalat', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('peminjaman.index', compact('peminjaman', 'search'));
    }

    public function userIndex(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with(['alat.kategori'])
            ->where('iduser', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('idpinjam', 'like', "%{$search}%")
                    ->orWhereHas('alat', function ($q) use ($search) {
                        $q->where('namaalat', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('peminjaman.index', compact('peminjaman', 'search'))->extends('layouts.user-dashboard');
    }

    public function create()
    {
        $alat = Alat::with('kategori')->where('qty', '>', 0)->get();
        return view('peminjaman.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idalat' => 'required|exists:alat,idalat',
            'qty' => 'required|integer|min:1',
            'tglpinjam' => 'required|date',
            'tglkembali' => 'nullable|date|after:tglpinjam',
            'kondisiakhir' => 'nullable|string',
        ]);

        $alat = Alat::findOrFail($validated['idalat']);
        if ($alat->qty < $validated['qty']) {
            return back()->withErrors(['qty' => 'Stok tidak mencukupi!']);
        }

        $validated['iduser'] = Auth::id();
        $validated['status'] = 'menunggu';

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibuat - menunggu approval!');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load('alat.kategori', 'user');
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $alat = Alat::with('kategori')->get();
        return view('peminjaman.edit', compact('peminjaman', 'alat'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Admin only can approve/return - user can only edit own
        if (Auth::user()->role === 'user' && auth()->id() !== $peminjaman->iduser && !in_array($peminjaman->status, ['dikembalikan'])) {
            abort(403, 'Hanya admin yang bisa menyetujui atau mengubah status!');
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['menunggu', 'disetujui', 'dipinjam', 'dikembalikan'])],
            'kondisiakhir' => 'nullable|string',
            'tglkembali' => 'nullable|date',
        ]);

        // Admin approve: reduce stock
        if (Auth::user()->role === 'admin' && $validated['status'] === 'disetujui' && $peminjaman->status === 'menunggu') {
            $peminjaman->alat->decrement('qty', $peminjaman->qty);
        }

        // Return (admin or user returning own): restore stock
        if ($validated['status'] === 'dikembalikan' && $peminjaman->status !== 'dikembalikan') {
            $peminjaman->alat->increment('qty', $peminjaman->qty);
        }

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Status peminjaman berhasil diupdate!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Restore stock if not returned
        if (!in_array($peminjaman->status, ['dikembalikan'])) {
            $peminjaman->alat->increment('qty', $peminjaman->qty);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman dihapus!');
    }
}
