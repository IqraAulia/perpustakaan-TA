<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        return view('page.user.index');

    }
    public function store(Request $request)
    {
        // Simpan user baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui user
    }

    public function destroy($id)
    {
        // Hapus user
    }
}
