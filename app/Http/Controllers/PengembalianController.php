<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('page.pengembalian.index');

    }
    public function store(Request $request)
    {
        // Simpan pengembalian baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui pengembalian
    }

    public function destroy($id)
    {
        // Hapus pengembalian
    }
    public function detail()
    {
        return view('page.pengembalian.detail');

    }
}
