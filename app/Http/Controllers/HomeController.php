<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::with('kategori')->where('qty', '>', 0);

        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('namaalat', 'like', "%{$search}%")
                  ->orWhere('spesifikasi', 'like', "%{$search}%");
            });
        }

        if ($kategori = $request->get('kategori')) {
            $query->where('idkategori', $kategori);
        }

        $alat = $query->paginate(12);
        $alat->appends($request->query());

        $kategoris = Kategori::pluck('namakategori', 'idkategori');

        return view('home', compact('alat', 'kategoris'));
    }
}

