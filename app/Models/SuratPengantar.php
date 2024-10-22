<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'user_id',
        'jenis_layanan_id',
        'status',
        'dokumen',
        'berkas_pendukung',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'jenis_layanan_id');    }

}
