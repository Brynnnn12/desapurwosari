<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
    ];

    public function suratPengantar()
    {
        return $this->hasMany(SuratPengantar::class);
    }
}
