<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'idalat';
    public $incrementing = true;
    protected $fillable = ['idkategori', 'namaalat', 'spesifikasi', 'gambaralat', 'qty'];

    protected $casts = [
        'qty' => 'integer',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'idalat', 'idalat');
    }

    public function alatMasuk(): HasMany
    {
        return $this->hasMany(AlatMasuk::class, 'idalat', 'idalat');
    }
}
