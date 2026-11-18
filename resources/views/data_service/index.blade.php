@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-modern">
            <div class="card-header-modern d-flex align-items-center gap-2">
                <i class="bi bi-tools text-warning fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Input Data Pengerjaan Service</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('data-service.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">ID Servis Pelanggan</label>
                        <select name="id_servis_pelanggan" id="id_servis_pelanggan" class="form-select" required>
                            <option value="" data-keluhan="">-- Pilih ID Servis Pelanggan --</option>
                            @foreach($daftarServices as $ds)
                                <option value="{{ $ds->id_servis_pelanggan }}" data-keluhan="{{ $ds->keluhan_kendaraan }}">
                                    {{ $ds->id_servis_pelanggan }} — {{ $ds->no_plat_kendaraan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-warning fw-semibold">
                            <i class="bi bi-lightning-charge-fill"></i> Keluhan Kendaraan (Otomatis)
                        </label>
                        <textarea id="keluhan_auto" class="form-control form-readonly-auto" rows="2" readonly placeholder="Otomatis terisi saat ID servis dipilih..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Estimasi Service</label>
                        <input type="text" name="estimasi_service" class="form-control" placeholder="Contoh: 1 Jam 30 Menit" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Nama Mekanik</label>
                        <input type="text" name="nama_mekanik" class="form-control" placeholder="Nama mekanik yang menangani" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-semibold">Sparepart Pengganti</label>
                        <textarea name="sparepart_pengganti" class="form-control" rows="2" placeholder="Contoh: Oli Yamalube Matic, Kampas Rem Depan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-amber w-100">
                        <i class="bi bi-save2 me-1"></i> Simpan Data Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-modern">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-gear-wide-connected text-warning fs-5"></i>
                    <h6 class="mb-0 fw-bold text-white">Riwayat Pengerjaan Service</h6>
                </div>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                    Total: {{ $dataServices->count() }} Data
                </span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-dark table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th>ID Servis</th>
                            <th>Keluhan</th>
                            <th>Estimasi</th>
                            <th>Nama Mekanik</th>
                            <th>Sparepart Pengganti</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataServices as $d)
                        <tr>
                            <td><span class="badge bg-warning text-dark fw-bold">{{ $d->id_servis_pelanggan }}</span></td>
                            <td class="small text-secondary">{{ $d->daftarService->keluhan_kendaraan ?? '-' }}</td>
                            <td><span class="badge bg-secondary-subtle text-light">{{ $d->estimasi_service }}</span></td>
                            <td class="fw-semibold text-white">{{ $d->nama_mekanik }}</td>
                            <td class="small">{{ $d->sparepart_pengganti }}</td>
                            <td class="text-center">
                                <form action="{{ route('data-service.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Hapus data service ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-secondary">Belum ada data pengerjaan service.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('id_servis_pelanggan').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    document.getElementById('keluhan_auto').value = selected.getAttribute('data-keluhan') || '';
});
</script>
@endsection