<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
    ];

    // Relasi: setiap catatan hanya dimiliki satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
