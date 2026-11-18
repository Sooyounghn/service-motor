<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat_pelanggan' => 'required',
            'pekerjaan' => 'required',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil disimpan');
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan dihapus');
    }
}
