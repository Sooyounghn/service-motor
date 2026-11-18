<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    public function index()
    {
        return response()->json(DaftarService::with(['pelanggan', 'kendaraan'])->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|unique:daftar_services,id_servis_pelanggan',
            'no_plat_kendaraan' => 'required|exists:kendaraans,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $service = DaftarService::create($validated);
        return response()->json(['message' => 'Daftar service berhasil ditambahkan', 'data' => $service], 201);
    }

    public function show($id)
    {
        return response()->json(DaftarService::with(['pelanggan', 'kendaraan'])->findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $service = DaftarService::findOrFail($id);
        $service->update($request->all());
        return response()->json(['message' => 'Daftar service berhasil diperbarui', 'data' => $service], 200);
    }

    public function destroy($id)
    {
        DaftarService::findOrFail($id)->delete();
        return response()->json(['message' => 'Daftar service berhasil dihapus'], 200);
    }
}