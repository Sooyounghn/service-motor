@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-modern">
            <div class="card-header-modern d-flex align-items-center gap-2">
                <i class="bi bi-clipboard2-plus-fill text-warning fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Registrasi Daftar Service</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('daftar-service.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">ID Servis Pelanggan</label>
                        <input type="text" name="id_servis_pelanggan" class="form-control" placeholder="Contoh: SRV001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">No Plat Kendaraan</label>
                        <select name="no_plat_kendaraan" class="form-select" required>
                            <option value="">-- Pilih No Plat Kendaraan --</option>
                            @foreach($kendaraans as $k)
                                <option value="{{ $k->no_plat_kendaraan }}">{{ $k->no_plat_kendaraan }} ({{ $k->nama_pemilik }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">ID Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                            <option value="" data-nama="">-- Pilih ID Pelanggan --</option>
                            @foreach($pelanggans as $p)
                                <option value="{{ $p->id_pelanggan }}" data-nama="{{ $p->nama_lengkap }}">{{ $p->id_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-warning fw-semibold">
                            <i class="bi bi-lightning-charge-fill"></i> Nama Pelanggan (Otomatis)
                        </label>
                        <input type="text" id="nama_pelanggan_auto" class="form-control form-readonly-auto" readonly placeholder="Muncul otomatis saat ID dipilih...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Keluhan Kendaraan</label>
                        <textarea name="keluhan_kendaraan" class="form-control" rows="2" placeholder="Contoh: Tarikan berat & ganti oli" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-semibold">Tanggal Servis</label>
                        <input type="date" name="tanggal_servis" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-amber w-100">
                        <i class="bi bi-check2-circle me-1"></i> Daftarkan Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-modern">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-text text-warning fs-5"></i>
                    <h6 class="mb-0 fw-bold text-white">Antrean & Daftar Service</h6>
                </div>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                    Total: {{ $daftarServices->count() }} Servis
                </span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-dark table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th>ID Servis</th>
                            <th>No Plat</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Keluhan Kendaraan</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarServices as $ds)
                        <tr>
                            <td><span class="badge bg-warning text-dark fw-bold">{{ $ds->id_servis_pelanggan }}</span></td>
                            <td><span class="badge bg-dark border border-secondary">{{ $ds->no_plat_kendaraan }}</span></td>
                            <td class="small">{{ $ds->id_pelanggan }}</td>
                            <td class="fw-semibold text-white">{{ $ds->pelanggan->nama_lengkap ?? '-' }}</td>
                            <td class="small text-secondary">{{ $ds->keluhan_kendaraan }}</td>
                            <td class="small">{{ $ds->tanggal_servis }}</td>
                            <td class="text-center">
                                <form action="{{ route('daftar-service.destroy', $ds->id_servis_pelanggan) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">Belum ada pendaftaran service.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('id_pelanggan').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    document.getElementById('nama_pelanggan_auto').value = selected.getAttribute('data-nama') || '';
});
</script>
@endsection