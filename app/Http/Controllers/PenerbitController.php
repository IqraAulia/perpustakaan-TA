<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenerbitController extends Controller
{
    public function index()
    {
        return view('page.penerbit.index', [
            'penerbit' => Penerbit::all(),
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            Penerbit::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('penerbit.index')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return response()->json($penerbit);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $penerbit = Penerbit::findOrFail($id);
            $penerbit->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('penerbit.index')->with('success', 'Berhasil memperbarui data');
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
            $penerbit = Penerbit::findOrFail($id);
            $penerbit->delete();

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
