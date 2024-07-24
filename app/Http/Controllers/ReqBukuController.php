<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReqBukuController extends Controller
{
    public function index()
    {
        return view('page.req-buku.index');

    }
    public function store(Request $request)
    {
        // Simpan req-buku baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui req-buku
    }

    public function destroy($id)
    {
        // Hapus req-buku
    }
}
