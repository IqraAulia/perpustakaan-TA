<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $fillable = [
        'nama',
        'tgl_lahir',
        'alamat',
    ];
}
