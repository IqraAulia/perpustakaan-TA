<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::selectRaw("
                    bukus.*,
                    kategoris.nama as kategori,
                    pengarangs.nama as pengarang,
                    penerbits.nama as penerbit
                ")
            ->join('kategoris', 'bukus.kategori_id', 'kategoris.id')
            ->join('pengarangs', 'bukus.pengarang_id', 'pengarangs.id')
            ->join('penerbits', 'bukus.penerbit_id', 'penerbits.id')
            ->get();

        // Exclude categories with 'nonaktif' status
        $kategori = Kategori::where('status', '!=', 'nonaktif')->get();
        $pengarang = Pengarang::get();
        $penerbit = Penerbit::get();

        if (Auth::user()->role == 'Mahasiswa') {
            return redirect()->route('home');
        }else {
            return view('page.buku.index', [
                'bukus' => $bukus,
                'kategori' => $kategori,
                'pengarang' => $pengarang,
                'penerbit' => $penerbit,
            ]);
        }

        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_buku' => 'required',
            'daftar_isi' => 'required',
            'kategori_id' => 'required',
            'pengarang_id' => 'required',
            'penerbit_id' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'status' => 'required',
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
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = str_replace(' ', '-', $originalName) . '.' . $file->getClientOriginalExtension();
                $gambarBukuPath = $file->storeAs('gambar_buku', $fileName, 'public');
            }

            Buku::create([
                'gambar_buku' => $gambarBukuPath,
                'judul_buku' => $request->judul_buku,
                'daftar_isi' => $request->daftar_isi,
                'kategori_id' => $request->kategori_id,
                'pengarang_id' => $request->pengarang_id,
                'penerbit_id' => $request->penerbit_id,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'status' => $request->status,
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
            'gambar_buku' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_buku' => 'required',
            'daftar_isi' => 'required',
            'kategori_id' => 'required',
            'pengarang_id' => 'required',
            'penerbit_id' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $buku = Buku::findOrFail($id);

            $gambarBukuPath = $buku->gambar_buku; // Keep the old image if no new one is uploaded
            if ($request->hasFile('gambar_buku')) {
                // Delete the old image
                if ($gambarBukuPath) {
                    Storage::disk('public')->delete($gambarBukuPath);
                }

                $file = $request->file('gambar_buku');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = str_replace(' ', '-', $originalName) . '.' . $file->getClientOriginalExtension();
                $gambarBukuPath = $file->storeAs('gambar_buku', $fileName, 'public');
            }

            $buku->update([
                'gambar_buku' => $gambarBukuPath,
                'judul_buku' => $request->judul_buku,
                'daftar_isi' => $request->daftar_isi,
                'kategori_id' => $request->kategori_id,
                'pengarang_id' => $request->pengarang_id,
                'penerbit_id' => $request->penerbit_id,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'status' => $request->status,
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
    public function showDetail($id)
    {
        $buku = Buku::selectRaw("
                    bukus.*,
                    kategoris.nama as kategori,
                    pengarangs.nama as pengarang,
                    penerbits.nama as penerbit
                ")
            ->join('kategoris', 'bukus.kategori_id', 'kategoris.id')
            ->join('pengarangs', 'bukus.pengarang_id', 'pengarangs.id')
            ->join('penerbits', 'bukus.penerbit_id', 'penerbits.id')
            ->where('bukus.id', $id)
            ->firstOrFail();

        return response()->json($buku);
    }
}
