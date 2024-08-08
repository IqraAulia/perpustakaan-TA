<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'created_by',
        'user_id',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_kembalikan',
    ];

    public function peminjamanDetail()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
    public function buku()
    {
        return $this->belongsToMany(Buku::class)->withPivot('quantity');
    }
}
