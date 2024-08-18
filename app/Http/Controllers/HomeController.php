<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class HomeController extends Controller
{
    public function index()
    {
        $bukusTersedia = Buku::where('status', 'tersedia')->count();
        $bukusDiajukan = Buku::where('status', 'diajukan')->count();
        $listDiajukan = Buku::selectRaw("
        bukus.*,
        kategoris.nama as kategori,
        pengarangs.nama as pengarang,
        penerbits.nama as penerbit
    ")
            ->join('kategoris', 'bukus.kategori_id', '=', 'kategoris.id')
            ->join('pengarangs', 'bukus.pengarang_id', '=', 'pengarangs.id')
            ->join('penerbits', 'bukus.penerbit_id', '=', 'penerbits.id')
            ->where('bukus.status', 'diajukan')
            ->get();
        $listpeminjamans = Peminjaman::with(['peminjamanDetail.buku', 'denda'])->selectRaw("
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
        $riwayat = Peminjaman::with(['peminjamanDetail.buku', 'denda'])
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
        $chartkategori = Buku::select('kategoris.nama', DB::raw('count(*) as total'))
            ->join('kategoris', 'bukus.kategori_id', '=', 'kategoris.id')
            ->groupBy('kategoris.nama')
            ->pluck('total', 'kategoris.nama');
        $chartPenerbit = Buku::select('penerbits.nama', DB::raw('count(*) as total'))
            ->join('penerbits', 'bukus.penerbit_id', '=', 'penerbits.id')
            ->groupBy('penerbits.nama')
            ->pluck('total', 'penerbits.nama');
        $chartPengarang = Buku::select('pengarangs.nama', DB::raw('count(*) as total'))
            ->join('pengarangs', 'bukus.pengarang_id', '=', 'pengarangs.id')
            ->groupBy('pengarangs.nama')
            ->pluck('total', 'pengarangs.nama');
        $chartUserRoles = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        $kategori = Kategori::count();
        $pengarang = Pengarang::count();
        $user = User::where('role', '!=', 'mahasiswa')->count();
        $mahasiswa = User::where('role', 'mahasiswa')->count();
        $peminjaman = Peminjaman::count();
        $peminjamans = Peminjaman::where('user_id', Auth::id())->count();
        $penerbit = Penerbit::count();


        return view('dashboard', [
            'bukusTersedia' => $bukusTersedia,
            'bukusDiajukan' => $bukusDiajukan,
            'listDiajukan' => $listDiajukan,
            'kategori' => $kategori,
            'chartkategori' => $chartkategori,
            'chartPenerbit' => $chartPenerbit,
            'chartPengarang' => $chartPengarang,
            'chartUserRoles' => $chartUserRoles,
            'pengarang' => $pengarang,
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'peminjaman' => $peminjaman,
            'peminjamans' => $peminjamans,
            'listpeminjamans' => $listpeminjamans,
            'riwayat' => $riwayat,
            'penerbit' => $penerbit,
        ]);
    }

    public function exportPDF()
{
    $listDiajukan = Buku::selectRaw("
        bukus.*,
        kategoris.nama as kategori,
        pengarangs.nama as pengarang,
        penerbits.nama as penerbit
    ")
        ->join('kategoris', 'bukus.kategori_id', '=', 'kategoris.id')
        ->join('pengarangs', 'bukus.pengarang_id', '=', 'pengarangs.id')
        ->join('penerbits', 'bukus.penerbit_id', '=', 'penerbits.id')
        ->where('bukus.status', 'diajukan')
        ->get();

    $pdf = Pdf::loadView('pdf.listDiajukan', ['listDiajukan' => $listDiajukan]);
    return $pdf->download('Daftar_Buku_Diajukan.pdf');
}

}
