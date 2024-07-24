<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        return view('page.buku.index');

    }
    public function store(Request $request)
    {
        // Simpan buku baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui buku
    }

    public function destroy($id)
    {
        // Hapus buku
    }
    public function detail()
    {
        return view('page.buku.detail');
    }
}
