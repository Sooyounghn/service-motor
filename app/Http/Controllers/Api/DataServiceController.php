<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index()
    {
        return response()->json(DataService::with('daftarService')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_services,id_servis_pelanggan',
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string',
            'sparepart_pengganti' => 'required|string',
        ]);

        $dataService = DataService::create($validated);
        return response()->json(['message' => 'Data service berhasil ditambahkan', 'data' => $dataService], 201);
    }

    public function show($id)
    {
        return response()->json(DataService::with('daftarService')->findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $dataService = DataService::findOrFail($id);
        $dataService->update($request->all());
        return response()->json(['message' => 'Data service berhasil diperbarui', 'data' => $dataService], 200);
    }

    public function destroy($id)
    {
        DataService::findOrFail($id)->delete();
        return response()->json(['message' => 'Data service berhasil dihapus'], 200);
    }
}
