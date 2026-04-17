<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch recent activities based on user role
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact('recentActivities'));
    }

    private function getRecentActivities()
    {
        $query = Peminjaman::with(['alat', 'user'])
            ->orderBy('tglpinjam', 'desc')
            ->limit(10);

        // Role-based filtering
        if (Auth::user()->role === 'user') {
            $query->where('iduser', Auth::id());
        }
        // Admin and petugas can see all

        return $query->get();
    }
}