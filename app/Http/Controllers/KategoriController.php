<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
   
    public function index()
    {
        return view('page.kategori.index');

    }
    public function store(Request $request)
    {
        // Simpan kategori baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui kategori
    }

    public function destroy($id)
    {
        // Hapus kategori
    }
}
