<?php

namespace App\Http\Controllers;

use App\Enums\PeminjamanStatus;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat.kategori'])
            ->orderBy('created_at', 'desc');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('catatan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  })
                  ->orWhereHas('alat', function ($alatQuery) use ($search) {
                      $alatQuery->where('namaalat', 'like', "%{$search}%");
                  });
            });
        }

        $peminjaman = $query->paginate(15);
        $peminjaman->appends($request->query());

        return view('laporan.index', compact('peminjaman'));
    }

    public function print($id)
    {
        $peminjaman = Peminjaman::with(['user', 'alat.kategori'])->findOrFail($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.print-single', compact('peminjaman'));
        return $pdf->stream('laporan-peminjaman-' . $peminjaman->idpinjam . '.pdf');
    }

    public function printAll(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat.kategori'])->orderBy('created_at', 'desc');
        
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('catatan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  })
                  ->orWhereHas('alat', function ($alatQuery) use ($search) {
                      $alatQuery->where('namaalat', 'like', "%{$search}%");
                  });
            });
        }

        $peminjaman = $query->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.print-all', compact('peminjaman'));
        return $pdf->stream('laporan-peminjaman-semua.pdf');
    }
}

