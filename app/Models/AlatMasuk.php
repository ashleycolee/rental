<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlatMasuk extends Model
{
    use HasFactory;

    protected $table = 'alat_masuk';
    protected $primaryKey = 'idmasuk';
    public $incrementing = true;
    protected $fillable = ['tglmasuk', 'idalat', 'qty'];

    protected $casts = [
        'tglmasuk' => 'date',
    ];

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'idalat', 'idalat');
    }
}
