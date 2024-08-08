<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'gambar_buku',
        'judul_buku',
        'daftar_isi',
        'kategori_id',
        'pengarang_id',
        'penerbit_id',
        'tahun_terbit',
        'stok',
        'status',
    ];
    public function peminjamans()
    {
        return $this->belongsToMany(Peminjaman::class)->withPivot('quantity');
    }
}


