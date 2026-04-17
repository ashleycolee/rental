<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Semua</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        .header { text-align: center; margin-bottom: 40px; border-bottom: 3px solid #1e40af; padding-bottom: 20px; }
        .logo { font-size: 28px; font-weight: bold; color: #1e40af; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: left; font-size: 12px; }
        .table th { background-color: #1e40af; color: white; font-weight: bold; }
        .status { padding: 4px 8px; border-radius: 10px; font-size: 10px; font-weight: bold; }
        .status.menunggu { background-color: #fef3c7; color: #f59e0b; }
        .status.disetujui { background-color: #d1fae5; color: #10b981; }
        .status.dipinjam { background-color: #bfdbfe; color: #3b82f6; }
        .status.dikembalikan { background-color: #f3f4f6; color: #6b7280; }
        .footer { margin-top: 40px; text-align: center; font-size: 11px; color: #999; border-top: 1px solid #eee; padding-top: 20px; }
        @page { margin: 2cm; }
        @media print { body { margin: 0; font-size: 11px; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">The Fluid Exchange</div>
        <h1>Laporan Peminjaman Lengkap</h1>
        <p>Dicetak pada {{ now()->format('d M Y H:i') }} | Total: {{ $peminjaman->count() }} record</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Tgl Pinjam</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
            <tr>
                <td>#{{ $item->idpinjam }}</td>
                <td>{{ $item->user->namalengkap ?? $item->user->username }}</td>
                <td>{{ $item->alat->namaalat }}</td>
                <td>{{ $item->tglpinjam->format('d M Y') }}</td>
                <td>{{ $item->qty }}</td>
                <td><span class="status status-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px;">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan oleh sistem The Fluid Exchange</p>
        <p>Halaman 1 dari 1</p>
    </div>
</body>
</html>

