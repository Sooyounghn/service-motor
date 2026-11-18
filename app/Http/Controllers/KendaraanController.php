<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_plat_kendaraan' => 'required|unique:kendaraans,no_plat_kendaraan',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required',
            'tahun_pembuatan' => 'required|digits:4',
            'nama_pemilik' => 'required',
            'warna_kendaraan' => 'required',
        ]);

        Kendaraan::create($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil disimpan');
    }

    public function destroy($id)
    {
        Kendaraan::findOrFail($id)->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan dihapus');
    }
}
