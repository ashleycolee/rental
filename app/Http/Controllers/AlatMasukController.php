<?php

namespace App\Http\Controllers;

use App\Models\AlatMasuk;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatMasukController extends Controller
{
    public function index(Request $request)
    {
        $alatMasuk = AlatMasuk::with('alat.kategori')
            ->when($request->search, function ($query, $search) {
                return $query->whereHas('alat', function ($q) use ($search) {
                    $q->where('namaalat', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('alat-masuk.index', compact('alatMasuk'));
    }

    public function create()
    {
        $alat = Alat::with('kategori')->get();
        return view('alat-masuk.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idalat' => 'required|exists:alat,idalat',
            'qty' => 'required|integer|min:1',
            'tglmasuk' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            AlatMasuk::create($validated);
            Alat::find($validated['idalat'])->increment('qty', $validated['qty']);
        });

        return redirect()->route('alat-masuk.index')
            ->with('success', 'Stok alat berhasil ditambah!');
    }

    public function show(AlatMasuk $alatMasuk)
    {
        $alatMasuk->load('alat.kategori');
        return view('alat-masuk.show', compact('alatMasuk'));
    }

    public function edit(AlatMasuk $alatMasuk)
    {
        $alat = Alat::with('kategori')->get();
        return view('alat-masuk.edit', compact('alatMasuk', 'alat'));
    }

    public function update(Request $request, AlatMasuk $alatMasuk)
    {
        $oldQty = $alatMasuk->qty;
        $validated = $request->validate([
            'idalat' => 'required|exists:alat,idalat',
            'qty' => 'required|integer|min:1',
            'tglmasuk' => 'required|date',
        ]);

        DB::transaction(function () use ($alatMasuk, $oldQty, $validated) {
            $alatMasuk->alat->increment('qty', $oldQty * -1);
            Alat::find($validated['idalat'])->increment('qty', $validated['qty']);
            $alatMasuk->update($validated);
        });

        return redirect()->route('alat-masuk.index')
            ->with('success', 'Data alat masuk diupdate!');
    }

    public function destroy(AlatMasuk $alatMasuk)
    {
        $alatMasuk->alat->decrement('qty', $alatMasuk->qty);
        $alatMasuk->delete();

        return redirect()->route('alat-masuk.index')
            ->with('success', 'Data alat masuk dihapus!');
    }
}

