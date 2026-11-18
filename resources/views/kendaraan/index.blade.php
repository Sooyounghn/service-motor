@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-modern">
            <div class="card-header-modern d-flex align-items-center gap-2">
                <i class="bi bi-bicycle text-warning fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Input Data Kendaraan</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('kendaraan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">No Plat Kendaraan</label>
                        <input type="text" name="no_plat_kendaraan" class="form-control text-uppercase" placeholder="BL 1234 XY" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold d-block">Jenis Kendaraan</label>
                        <div class="d-flex gap-2">
                            <label class="radio-card d-flex align-items-center gap-2" for="matic">
                                <input class="form-check-input mt-0" type="radio" name="jenis_kendaraan" id="matic" value="Matic" required>
                                <span class="small fw-semibold">Matic</span>
                            </label>
                            <label class="radio-card d-flex align-items-center gap-2" for="manual">
                                <input class="form-check-input mt-0" type="radio" name="jenis_kendaraan" id="manual" value="Manual Transmisi" required>
                                <span class="small fw-semibold">Manual Transmisi</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">No STNK</label>
                        <input type="text" name="no_stnk" class="form-control" placeholder="Nomor STNK" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small text-secondary fw-semibold">Tahun Pembuatan</label>
                            <input type="number" name="tahun_pembuatan" class="form-control" placeholder="2024" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small text-secondary fw-semibold">Warna Kendaraan</label>
                            <input type="text" name="warna_kendaraan" class="form-control" placeholder="Hitam Doff" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-semibold">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="form-control" placeholder="Sesuai STNK" required>
                    </div>
                    <button type="submit" class="btn btn-amber w-100">
                        <i class="bi bi-save2 me-1"></i> Simpan Data Kendaraan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-modern">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-card-list text-warning fs-5"></i>
                    <h6 class="mb-0 fw-bold text-white">Data Kendaraan Terdaftar</h6>
                </div>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                    Total: {{ $kendaraans->count() }} Unit
                </span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-dark table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th>No Plat</th>
                            <th>Jenis Kendaraan</th>
                            <th>No STNK</th>
                            <th>Tahun</th>
                            <th>Nama Pemilik</th>
                            <th>Warna</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraans as $k)
                        <tr>
                            <td><span class="badge bg-dark border border-secondary text-white px-2 py-1">{{ $k->no_plat_kendaraan }}</span></td>
                            <td>
                                @if($k->jenis_kendaraan == 'Matic')
                                    <span class="badge bg-info-subtle text-info rounded-pill px-3">Matic</span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Manual Transmisi</span>
                                @endif
                            </td>
                            <td class="small">{{ $k->no_stnk }}</td>
                            <td>{{ $k->tahun_pembuatan }}</td>
                            <td class="fw-semibold text-white">{{ $k->nama_pemilik }}</td>
                            <td>{{ $k->warna_kendaraan }}</td>
                            <td class="text-center">
                                <form action="{{ route('kendaraan.destroy', $k->no_plat_kendaraan) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">Belum ada data kendaraan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection