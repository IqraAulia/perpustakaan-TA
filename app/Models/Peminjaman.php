<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kategori_id',
        'jumlah',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'kondisi_buku_pinjam',
    ];
}
