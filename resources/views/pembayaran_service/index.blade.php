@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-modern">
            <div class="card-header-modern d-flex align-items-center gap-2">
                <i class="bi bi-wallet2 text-warning fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Form Pembayaran Service</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pembayaran-service.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">ID Servis Pelanggan</label>
                        <select name="id_servis_pelanggan" class="form-select" required>
                            <option value="">-- Pilih ID Servis Pelanggan --</option>
                            @foreach($daftarServices as $ds)
                                <option value="{{ $ds->id_servis_pelanggan }}">{{ $ds->id_servis_pelanggan }} — {{ $ds->no_plat_kendaraan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Jumlah Biaya Servis (Rp)</label>
                        <input type="number" name="jumlah_biaya_servis" class="form-control" placeholder="Contoh: 185000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold d-block">Jenis Pembayaran</label>
                        <div class="d-flex gap-2">
                            <label class="radio-card d-flex align-items-center gap-2" for="cash">
                                <input class="form-check-input mt-0" type="radio" name="jenis_pembayaran" id="cash" value="Cash / Tunai" required>
                                <span class="small fw-semibold">Cash / Tunai</span>
                            </label>
                            <label class="radio-card d-flex align-items-center gap-2" for="nontunai">
                                <input class="form-check-input mt-0" type="radio" name="jenis_pembayaran" id="nontunai" value="Non Tunai" required>
                                <span class="small fw-semibold">Non Tunai</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Lunas / Catatan tambahan (opsional)"></textarea>
                    </div>
                    <button type="submit" class="btn btn-amber w-100">
                        <i class="bi bi-cash-coin me-1"></i> Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-modern">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-receipt text-warning fs-5"></i>
                    <h6 class="mb-0 fw-bold text-white">Riwayat Transaksi Pembayaran</h6>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                    Total Transaksi: {{ $pembayarans->count() }}
                </span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-dark table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th>ID Servis</th>
                            <th>Jumlah Biaya Servis</th>
                            <th>Jenis Pembayaran</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans as $pb)
                        <tr>
                            <td><span class="badge bg-warning text-dark fw-bold">{{ $pb->id_servis_pelanggan }}</span></td>
                            <td class="fw-bold text-success">Rp {{ number_format($pb->jumlah_biaya_servis, 0, ',', '.') }}</td>
                            <td>
                                @if($pb->jenis_pembayaran == 'Cash / Tunai')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">Cash / Tunai</span>
                                @else
                                    <span class="badge bg-info-subtle text-info rounded-pill px-3">Non Tunai</span>
                                @endif
                            </td>
                            <td class="small text-secondary">{{ $pb->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('pembayaran-service.destroy', $pb->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">Belum ada data pembayaran service.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection