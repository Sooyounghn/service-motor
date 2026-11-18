<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PembayaranService;
use Illuminate\Http\Request;

class PembayaranServiceController extends Controller
{
    public function index()
    {
        return response()->json(PembayaranService::with('daftarService')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_services,id_servis_pelanggan',
            'jumlah_biaya_servis' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = PembayaranService::create($validated);
        return response()->json(['message' => 'Pembayaran service berhasil ditambahkan', 'data' => $pembayaran], 201);
    }

    public function show($id)
    {
        return response()->json(PembayaranService::with('daftarService')->findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranService::findOrFail($id);
        $pembayaran->update($request->all());
        return response()->json(['message' => 'Pembayaran service berhasil diperbarui', 'data' => $pembayaran], 200);
    }

    public function destroy($id)
    {
        PembayaranService::findOrFail($id)->delete();
        return response()->json(['message' => 'Pembayaran service berhasil dihapus'], 200);
    }
}
