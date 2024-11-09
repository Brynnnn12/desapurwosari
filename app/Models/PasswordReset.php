<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';
    public $incrementing = false; // Non-automatic incrementing
    protected $keyType = 'string'; // Use string for the key ty

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
    protected $table = 'password_reset_tokens';
    public $timestamps = false;
}
