<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index()
    {
        $dataServices = DataService::with('daftarService')->get();
        $daftarServices = DaftarService::all();
        return view('data_service.index', compact('dataServices', 'daftarServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_servis_pelanggan' => 'required',
            'estimasi_service' => 'required',
            'nama_mekanik' => 'required',
            'sparepart_pengganti' => 'required',
        ]);

        DataService::create($request->all());
        return redirect()->route('data-service.index')->with('success', 'Data service berhasil disimpan');
    }

    public function destroy($id)
    {
        DataService::findOrFail($id)->delete();
        return redirect()->route('data-service.index')->with('success', 'Data service dihapus');
    }
}