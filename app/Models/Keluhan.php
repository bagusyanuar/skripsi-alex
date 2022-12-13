<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    protected $table = 'keluhan';

    protected $fillable = [
        'tanggal',
        'user_id',
        'deskripsi',
        'file',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
