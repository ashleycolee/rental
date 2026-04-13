<?php

namespace App\Enums;

enum PeminjamanStatus: string
{
    case MENUNGGU = 'menunggu';
    case DISETUJUI = 'disetujui';
    case DIPINJAM = 'dipinjam';
    case DIKEMBALIKAN = 'dikembalikan';

    public function label(): string
    {
        return match($this) {
            self::MENUNGGU => 'Menunggu',
            self::DISETUJUI => 'Disetujui',
            self::DIPINJAM => 'Dipinjam',
            self::DIKEMBALIKAN => 'Dikembalikan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::MENUNGGU => 'warning',
            self::DISETUJUI => 'success',
            self::DIPINJAM => 'info',
            self::DIKEMBALIKAN => 'gray',
        };
    }
}

