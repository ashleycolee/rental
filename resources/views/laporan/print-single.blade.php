<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman #{{ $peminjaman->idpinjam }}</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 40px;
            color: #1f2937;
            font-size: 14px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 22px;
            font-weight: 600;
            color: #1e3a8a;
            letter-spacing: 0.5px;
        }

        .title {
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-top: 5px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-box {
            width: 100%;
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: #374151;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .detail-table th {
            width: 30%;
            text-align: left;
            padding: 10px;
            background-color: #f3f4f6;
            font-weight: 600;
            border: 1px solid #e5e7eb;
        }

        .detail-table td {
            padding: 10px;
            border: 1px solid #e5e7eb;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-menunggu {
            background: #fef3c7;
            color: #b45309;
        }

        .status-disetujui {
            background: #d1fae5;
            color: #065f46;
        }

        .status-dipinjam {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-dikembalikan {
            background: #f3f4f6;
            color: #374151;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        @media print {
            body { margin: 0; }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <div class="logo">The Fluid Exchange</div>
        <div class="title">Laporan Peminjaman</div>
        <div class="subtitle">
            ID #{{ $peminjaman->idpinjam }} • {{ $peminjaman->created_at->format('d M Y H:i') }}
        </div>
    </div>

    <div class="info">
        <div class="info-box">
            <strong>Data Peminjam</strong>
            {{ $peminjaman->user->namalengkap ?? $peminjaman->user->username }}<br>
            {{ $peminjaman->user->username }}
        </div>

        <div class="info-box">
            <strong>Data Barang</strong>
            {{ $peminjaman->alat->namaalat }}<br>
            Kategori: {{ $peminjaman->alat->kategori->namakategori ?? 'N/A' }}
        </div>
    </div>

    <table class="detail-table">
        <tr>
            <th>Tanggal Pinjam</th>
            <td>{{ $peminjaman->tglpinjam->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $peminjaman->qty }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="status status-{{ $peminjaman->status }}">
                    {{ ucfirst($peminjaman->status) }}
                </span>
            </td>
        </tr>
        @if($peminjaman->catatan)
        <tr>
            <th>Catatan</th>
            <td>{{ $peminjaman->catatan }}</td>
        </tr>
        @endif
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }} <br>
        The Fluid Exchange
    </div>

</div>
</body>
</html>