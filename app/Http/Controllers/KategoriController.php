<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $kategoris = Kategori::when($search, function ($query, $search) {
            return $query->where('namakategori', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('kategori.index', compact('kategoris', 'search'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namakategori' => 'required|string|max:255|unique:kategori,namakategori',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'namakategori' => ['required', 'string', 'max:255', Rule::unique('kategori')->ignore($kategori->idkategori)],
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
