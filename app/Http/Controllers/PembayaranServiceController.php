<?php

namespace App\Http\Controllers;

use App\Models\PembayaranService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class PembayaranServiceController extends Controller
{
    public function index()
    {
        $pembayarans = PembayaranService::with('daftarService')->get();
        $daftarServices = DaftarService::all();
        return view('pembayaran_service.index', compact('pembayarans', 'daftarServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_servis_pelanggan' => 'required',
            'jumlah_biaya_servis' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable',
        ]);

        PembayaranService::create($request->all());
        return redirect()->route('pembayaran-service.index')->with('success', 'Pembayaran service berhasil disimpan');
    }

    public function destroy($id)
    {
        PembayaranService::findOrFail($id)->delete();
        return redirect()->route('pembayaran-service.index')->with('success', 'Data pembayaran dihapus');
    }
}