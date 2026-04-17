<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'idpinjam';
    public $incrementing = true;
    protected $fillable = ['tglpinjam', 'tglkembali', 'idalat', 'qty', 'iduser', 'kondisiakhir', 'status', 'catatan'];

    protected $casts = [
        'tglpinjam' => 'date',
        'tglkembali' => 'date',
        'status' => 'string',
    ];

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'idalat', 'idalat');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }
}
