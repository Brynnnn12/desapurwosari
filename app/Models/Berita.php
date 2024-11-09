<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'judul',
        'isi',
        'tanggal_terbit',
        'foto',
        'video',
        'user_id',
        'slug',
    ];
    protected $casts = [
        'tanggal_terbit' => 'datetime', // or 'date' if you only need the date
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });

        static::updating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });
    }

    // Relasi dengan model User (penulis berita)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
