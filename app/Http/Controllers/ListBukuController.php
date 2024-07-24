<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListBukuController extends Controller
{
    public function index()
    {
        return view('page.list-buku.index');
    }
    public function store(Request $request)
    {
        // Simpan list-buku baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui list-buku
    }

    public function destroy($id)
    {
        // Hapus list-buku
    }
}
