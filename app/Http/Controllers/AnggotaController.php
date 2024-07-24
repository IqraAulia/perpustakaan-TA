<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('page.anggota.index');

    }
    public function store(Request $request)
    {
        // Simpan anggota baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui anggota
    }

    public function destroy($id)
    {
        // Hapus anggota
    }
}
