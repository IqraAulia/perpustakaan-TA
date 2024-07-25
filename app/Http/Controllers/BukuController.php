<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        return view('page.buku.index', [
            'bukus' => Buku::all(),
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'gambar_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_buku' => 'required',
            'daftar_isi' => 'required',
            'kategori_id' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $gambarBukuPath = null;
            if ($request->hasFile('gambar_buku')) {
                $file = $request->file('gambar_buku');
                $gambarBukuPath = $file->store('gambar_buku', 'public');
            }

            Buku::create([
                'gambar_buku' => $gambarBukuPath,
                'judul_buku' => $request->judul_buku,
                'daftar_isi' => $request->daftar_isi,
                'kategori_id' => $request->kategori_id,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'status' => 'aktif',
                'kondisi' => $request->kondisi,
            ]);

            DB::commit();
            return redirect()->route('buku.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    }


    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return response()->json($buku);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_buku' => 'required',
            'daftar_isi' => 'required',
            'kategori_id' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $gambarBukuPath = null;
            if ($request->hasFile('gambar_buku')) {
                $file = $request->file('gambar_buku');
                $gambarBukuPath = $file->store('gambar_buku', 'public');
            }

            $buku = Buku::findOrFail($id);
            $buku->update([
                'gambar_buku' => $gambarBukuPath,
                'judul_buku' => $request->judul_buku,
                'daftar_isi' => $request->daftar_isi,
                'kategori_id' => $request->kategori_id,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'status' => 'aktif',
                'kondisi' => $request->kondisi,
            ]);

            DB::commit();
            return redirect()->route('buku.index')->with('success', 'Berhasil memperbarui data');
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
            $buku = Buku::findOrFail($id);
            $buku->delete();

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
    public function detail()
    {
        return view('page.buku.detail');
    }
}
