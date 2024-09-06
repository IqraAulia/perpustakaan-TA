<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengarangController extends Controller
{

    public function index()
    {
        

        if (Auth::user()->role == 'Mahasiswa') {
            return redirect()->route('home');
        }else {
            return view('page.pengarang.index', [
                'pengarang' => Pengarang::all(),
            ]);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            Pengarang::create([
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('pengarang.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return response()->json($pengarang);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $pengarang = Pengarang::findOrFail($id);
            $pengarang->update([
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('pengarang.index')->with('success', 'Berhasil memperbarui data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $pengarang = Pengarang::findOrFail($id);
            $pengarang->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $th->getMessage()
            ], 500);
        }
    }
}
