<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $alat = Alat::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('namaalat', 'like', "%{$search}%")
                    ->orWhere('spesifikasi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('alat.index', compact('alat', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::pluck('namakategori', 'idkategori');
        return view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaalat' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategori,idkategori',
            'spesifikasi' => 'nullable|string',
            'gambaralat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qty' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambaralat')) {
            $validated['gambaralat'] = $request->file('gambaralat')->store('alat', 'public');
        }

        Alat::create($validated);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show(Alat $alat)
    {
        return view('alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::pluck('namakategori', 'idkategori');
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'namaalat' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategori,idkategori',
            'spesifikasi' => 'nullable|string',
            'gambaralat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qty' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambaralat')) {
            if ($alat->gambaralat) {
                Storage::disk('public')->delete($alat->gambaralat);
            }
            $validated['gambaralat'] = $request->file('gambaralat')->store('alat', 'public');
        }

        $alat->update($validated);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil diupdate!');
    }

    public function destroy(Alat $alat)
    {
        if ($alat->gambaralat) {
            Storage::disk('public')->delete($alat->gambaralat);
        }

        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil dihapus!');
    }
}

