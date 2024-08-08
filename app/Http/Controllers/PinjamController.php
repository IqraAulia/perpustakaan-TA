<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class PinjamController extends Controller
{
    public function index()
    {
       
        return view('page.pinjam.index', [
            'bukus' => Buku::all(),
            'tglPinjam' => date('Y-m-d'),
            'tglKembali' => date('Y-m-d', strtotime('+7 days')),
        ]);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'nullable',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id.*' => 'required',
            'quantity.*' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::create([
                // 'user_id' => auth()->user()->id ,
                'user_id' => 1 ,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
            ]);

            foreach ($request->buku_id as $key => $buku_id) {
                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => $buku_id,
                    'jumlah' => $request->quantity[$key],
                ]);
            }

            DB::commit();
            return redirect()->route('pinjam.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    
    }

    public function update(Request $request, $id)
    {
        // Perbarui pinjam
    }

    public function destroy($id)
    {
        // Hapus pinjam
    }
}
