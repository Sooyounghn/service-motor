<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return response()->json(Kendaraan::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat_kendaraan' => 'required|unique:kendaraans,no_plat_kendaraan',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string',
            'tahun_pembuatan' => 'required|digits:4',
            'nama_pemilik' => 'required|string',
            'warna_kendaraan' => 'required|string',
        ]);

        $kendaraan = Kendaraan::create($validated);
        return response()->json(['message' => 'Data kendaraan berhasil ditambahkan', 'data' => $kendaraan], 201);
    }

    public function show($id)
    {
        return response()->json(Kendaraan::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());
        return response()->json(['message' => 'Data kendaraan berhasil diperbarui', 'data' => $kendaraan], 200);
    }

    public function destroy($id)
    {
        Kendaraan::findOrFail($id)->delete();
        return response()->json(['message' => 'Data kendaraan berhasil dihapus'], 200);
    }
}
