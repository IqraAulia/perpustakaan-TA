<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
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
        $peminjamans = Peminjaman::with(['peminjamanDetail.buku', 'denda'])->selectRaw("
                    peminjaman.*,
                    user_created.name as created_by_name,
                    user_created.role as created_by_role,
                    user.name as name,
                    user.role as role
                    ")
            ->join('users as user', 'peminjaman.user_id', '=', 'user.id')
            ->leftJoin('users as user_created', 'peminjaman.created_by', '=', 'user_created.id')
            ->whereIn('peminjaman.status', ['booking', 'dipinjam'])
            ->get();

        $peminjam = User::whereIn('users.role', ['Dosen', 'Mahasiswa'])->get();
        $petugas = User::whereIn('users.role', ['Super admin', 'Admin', 'Petugas', 'Kaprodi'])->get();

        return view('page.peminjaman.index', [
            'peminjamans' => $peminjamans,
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
            'status' => 'required',
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
                'user_id' => Auth::user()->id ,
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
    // public function destroy($id)
    // {
    //     try {
    //         $peminjaman = Peminjaman::findOrFail($id);
    //         $peminjaman->delete();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Berhasil menghapus data'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal menghapus data: ' . $th->getMessage()
    //         ], 500);
    //     }
    // }

    public function approve(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Update the buku_kode for each peminjaman detail
        foreach ($request->peminjaman_detail_id as $index => $detailId) {
            $peminjamanDetail = PeminjamanDetail::findOrFail($detailId);
            $peminjamanDetail->buku_kode = $request->buku_kode[$index];
            $peminjamanDetail->save();
        }

        // Update the status to 'dipinjam'
        $peminjaman->status = 'dipinjam';

        // Reduce the stock of each book
        foreach ($peminjaman->peminjamanDetail as $detail) {
            $buku = $detail->buku;
            $buku->stok -= $detail->jumlah;
            $buku->save();
        }
                    
        // Update created_by to the currently logged-in user
        $peminjaman->created_by = Auth::id();
        $peminjaman->save();

        return response()->json(['success' => 'Peminjaman approved!']);
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return response()->json(['success' => 'Peminjaman rejected!']);
    }

    public function complete(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'selesai';

        // Tambahkan stok buku kembali
        foreach ($peminjaman->peminjamanDetail as $detail) {
            $buku = $detail->buku;
            $buku->stok += $detail->jumlah;
            $buku->save();
        }

        // Periksa dan simpan denda jika ada
        if ($request->has('denda')) {
            Denda::create([
                'peminjaman_id' => $id,
                'denda' => $request->input('denda'),
                'deskripsi' => $request->input('deskripsi', ''),
            ]);
        }

        $peminjaman->save();

        return response()->json(['success' => 'Peminjaman completed!']);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->peminjamanDetail()->delete();
        $peminjaman->delete();

        return response()->json(['success' => 'Peminjaman deleted!']);
    }
}
