<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    public function index()
    {
        $daftarServices = DaftarService::with(['pelanggan', 'kendaraan'])->get();
        $kendaraans = Kendaraan::all();
        $pelanggans = Pelanggan::all();
        return view('daftar_service.index', compact('daftarServices', 'kendaraans', 'pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_servis_pelanggan' => 'required|unique:daftar_services,id_servis_pelanggan',
            'no_plat_kendaraan' => 'required',
            'id_pelanggan' => 'required',
            'keluhan_kendaraan' => 'required',
            'tanggal_servis' => 'required|date',
        ]);

        DaftarService::create($request->all());
        return redirect()->route('daftar-service.index')->with('success', 'Daftar service berhasil disimpan');
    }

    public function destroy($id)
    {
        DaftarService::findOrFail($id)->delete();
        return redirect()->route('daftar-service.index')->with('success', 'Daftar service dihapus');
    }
}