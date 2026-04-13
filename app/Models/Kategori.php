<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $incrementing = true;
    protected $fillable = ['namakategori'];

    public function alat(): HasMany
    {
        return $this->hasMany(Alat::class, 'idkategori', 'idkategori');
    }
}
