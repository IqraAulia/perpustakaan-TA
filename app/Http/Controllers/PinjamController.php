<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index()
    {
        return view('page.pinjam.index');

    }
    public function store(Request $request)
    {
        // Simpan pinjam baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui pinjam
    }

    public function destroy($id)
    {
        // Hapus pinjam
    }
}
