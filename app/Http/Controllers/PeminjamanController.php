<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('page.peminjaman.index');

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
