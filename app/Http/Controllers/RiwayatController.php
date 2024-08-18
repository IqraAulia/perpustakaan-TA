<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{

    public function index()
    {
        // Get the logged-in user
        $user = Auth::user();
    
        // Check the role of the logged-in user
        if (in_array($user->role, ['Super admin', 'Admin', 'Petugas', 'Kaprodi'])) {
            // If the user is one of the specified roles, retrieve all 'selesai' records
            $peminjamans = Peminjaman::with(['peminjamanDetail.buku', 'denda'])
                ->selectRaw("
                    peminjaman.*,
                    user_created.name as created_by_name,
                    user_created.role as created_by_role,
                    user.name as name,
                    user.role as role
                ")
                ->join('users as user', 'peminjaman.user_id', '=', 'user.id')
                ->leftJoin('users as user_created', 'peminjaman.created_by', '=', 'user_created.id')
                ->where('peminjaman.status', 'selesai')
                ->get();
        } else {
            // If the user is 'Dosen' or 'Mahasiswa', retrieve only their 'selesai' records
            $peminjamans = Peminjaman::with(['peminjamanDetail.buku', 'denda'])
                ->selectRaw("
                    peminjaman.*,
                    user_created.name as created_by_name,
                    user_created.role as created_by_role,
                    user.name as name,
                    user.role as role
                ")
                ->join('users as user', 'peminjaman.user_id', '=', 'user.id')
                ->leftJoin('users as user_created', 'peminjaman.created_by', '=', 'user_created.id')
                ->where('peminjaman.user_id', $user->id)
                ->get();
        }
    
        // Retrieve the list of peminjam and petugas
        $peminjam = User::whereIn('users.role', ['Dosen', 'Mahasiswa'])->get();
        $petugas = User::whereIn('users.role', ['Super admin', 'Admin', 'Petugas', 'Kaprodi'])->get();
    
        // Return the view with the data
        return view('page.riwayat.index', [
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
        // Simpan riwayat baru
    }

    public function update(Request $request, $id)
    {
        // Perbarui riwayat
    }

    public function destroy($id)
    {
        // Hapus riwayat
    }
    public function detail()
    {
        return view('page.riwayat.detail');

    }
}
