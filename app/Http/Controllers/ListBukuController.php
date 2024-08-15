<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;



class ListBukuController extends Controller
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
                ->where('bukus.status', '!=', 'diajukan') 
                ->get();
    
        $kategori = Kategori::get();
        $pengarang = Pengarang::get();
        $penerbit = Penerbit::get();
    
        return view('page.list-buku.index', [
            'bukus' => $bukus,
            'kategori' => $kategori,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
        ]);
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
