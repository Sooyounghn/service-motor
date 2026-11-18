<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return response()->json(Pelanggan::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $pelanggan = Pelanggan::create($validated);
        return response()->json(['message' => 'Data pelanggan berhasil ditambahkan', 'data' => $pelanggan], 201);
    }

    public function show($id)
    {
        return response()->json(Pelanggan::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());
        return response()->json(['message' => 'Data pelanggan berhasil diperbarui', 'data' => $pelanggan], 200);
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return response()->json(['message' => 'Data pelanggan berhasil dihapus'], 200);
    }
}
