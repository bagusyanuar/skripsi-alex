<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockKeluar extends Model
{
    use HasFactory;

    protected $table = 'stock_keluar';
    protected $fillable = [
        'tanggal',
        'sarana_id',
        'ruangan_id',
        'qty',
        'keterangan',
        'status',
        'deskripsi',
    ];

    public function sarana()
    {
        return $this->belongsTo(Sarana::class, 'sarana_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
