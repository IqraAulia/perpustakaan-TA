<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamen = Peminjaman::join('users', 'peminjamen.user_id', 'users.id')
                ->join('bukus', 'peminjamen.buku_id', 'bukus.id')
                ->get();
        return view('page.peminjaman.index', compact('peminjamen'));

    }
    public function store(Request $request)
    {
        // Simpan peminjaman baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui peminjaman
    }

    public function destroy($id)
    {
        // Hapus peminjaman
    }
    public function detail()
    {
        return view('page.peminjaman.detail');
    }
}
