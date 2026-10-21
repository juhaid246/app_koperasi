<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $fillable = [
        'pinjaman_id',
        'angsuran_ke',
        'jatuh_tempo',
        'jumlah_tagihan',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}