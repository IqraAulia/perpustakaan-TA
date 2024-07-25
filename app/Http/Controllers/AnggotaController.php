<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('page.anggota.index');

    }
    public function store(Request $request)
    {
       
        return view('page.anggota.index', [
            'anggotas' => Anggota::all(),
        ]);
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
