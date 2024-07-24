<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        return view('page.riwayat.index');

    }
    public function store(Request $request)
    {
        // Simpan riwayat baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui riwayat
    }

    public function destroy($id)
    {
        // Hapus riwayat
    }
    public function detail()
    {
        return view('page.riwayat.detail');

    }
}
