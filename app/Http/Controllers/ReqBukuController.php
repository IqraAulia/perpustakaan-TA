<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReqBukuController extends Controller
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

        $kategori = Kategori::get();
        $pengarang = Pengarang::get();
        $penerbit = Penerbit::get();

        return view('page.req-buku.index', [
            'bukus' => $bukus,
            'kategori' => $kategori,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
        ]);

    }
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'gambar_buku' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_buku' => 'required',
            'daftar_isi' => 'nullable',
            'kategori_id' => 'required',
            'pengarang_id' => 'required',
            'penerbit_id' => 'required',
            'tahun_terbit' => 'required',
            
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
                'pengarang_id' => $request->pengarang_id,
                'penerbit_id' => $request->penerbit_id,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => 0,
                'status' => 'Diajukan',
            ]);


            DB::commit();
            return redirect()->route('req-buku.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
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
