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

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::selectRaw("
                    peminjaman.*,
                    users.name as name,
                    users.role as role
                    ")
            ->join('users', 'peminjaman.user_id', 'users.id')
            ->get();

        $peminjam = User::whereIn('users.role', ['Dosen', 'Mahasiswa'])->get();
        $petugas = User::whereIn('users.role', ['Super admin', 'Admin', 'Petugas', 'Kaprodi'])->get();

        return view('page.peminjaman.index', [
            'peminjaman' => $peminjamans,
            'peminjam' => $peminjam,
            'petugas' => $petugas,
            'bukus' => Buku::all(),
            'tglPinjam' => date('Y-m-d'),
            'tglKembali' => date('Y-m-d', strtotime('+7 days')),
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'created_by' => 'required',
            'user_id' => 'required',
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
                'user_id' => $request->user_id,
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
            return redirect()->route('peminjaman.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        // Prepare buku items data
        $buku_items = $peminjaman->buku->map(function ($buku) {
            return [
                'buku_id' => $buku->id,
                'quantity' => $buku->pivot->quantity,
            ];
        });

        return response()->json([
            'created_by' => $peminjaman->created_by,
            'user_id' => $peminjaman->user_id,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'buku_items' => $buku_items,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required',
            'user_id' => 'required',
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


            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->update([
                'user_id' => $request->user_id,
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
            return redirect()->route('peminjaman.index')->with('success', 'Berhasil memperbarui data');
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
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->delete();

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
