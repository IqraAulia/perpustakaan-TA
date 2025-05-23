<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::selectRaw("
                    anggotas.*,
                    users.role as role
                    ")
            ->join('users', 'anggotas.user_id', 'users.id')
            ->get();
        
        $user = User::get();

        return view('page.anggota.index', [
            'anggotas' => $anggotas,
            'user' => $user,
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nomor_induk' => 'required',
            'alamat' => 'required',
            'noHp' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            Anggota::create([
                'user_id' => $request->user_id,
                'nama_lengkap' => $request->nama_lengkap,
                'nomor_induk' => $request->nomor_induk,
                'alamat' => $request->alamat,
                'noHp' => $request->noHp,
            ]);

            DB::commit();
            return redirect()->route('anggota.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $user = Anggota::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nomor_induk' => 'required',
            'alamat' => 'required',
            'noHp' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();


            $user = Anggota::findOrFail($id);
            $user->update([
                'user_id' => $request->user_id,
                'nama_lengkap' => $request->nama_lengkap,
                'nomor_induk' => $request->nomor_induk,
                'alamat' => $request->alamat,
                'noHp' => $request->noHp,
            ]);

            DB::commit();
            return redirect()->route('anggota.index')->with('success', 'Berhasil memperbarui data');
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
            $user = Anggota::findOrFail($id);
            $user->delete();

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
