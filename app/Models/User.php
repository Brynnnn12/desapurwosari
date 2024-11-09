<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nik',
        'alamat',
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date', // atau 'datetime'
    ];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
    public function suratPengantar()
    {
        return $this->hasMany(SuratPengantar::class);
    }
    public function beritas()
    {
        return $this->hasMany(Berita::class);
    }


}
