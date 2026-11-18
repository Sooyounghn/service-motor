@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-modern">
            <div class="card-header-modern d-flex align-items-center gap-2">
                <i class="bi bi-person-plus-fill text-warning fs-5"></i>
                <h6 class="mb-0 fw-bold text-white">Input Data Pelanggan</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">ID Pelanggan</label>
                        <input type="text" name="id_pelanggan" class="form-control" placeholder="Contoh: PLG001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap pelanggan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">No HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Alamat Pelanggan</label>
                        <textarea name="alamat_pelanggan" class="form-control" rows="2" placeholder="Alamat lengkap" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-secondary fw-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Mahasiswa / Karyawan / Wiraswasta" required>
                    </div>
                    <button type="submit" class="btn btn-amber w-100">
                        <i class="bi bi-save2 me-1"></i> Simpan Data Pelanggan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-modern">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-people text-warning fs-5"></i>
                    <h6 class="mb-0 fw-bold text-white">Daftar Pelanggan Terdaftar</h6>
                </div>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                    Total: {{ $pelanggans->count() }} Pelanggan
                </span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-dark table-hover table-modern mb-0">
                    <thead>
                        <tr>
                            <th>ID Pelanggan</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $p)
                        <tr>
                            <td><span class="badge bg-secondary-subtle text-warning fw-bold">{{ $p->id_pelanggan }}</span></td>
                            <td class="fw-semibold text-white">{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td class="text-secondary small">{{ $p->alamat_pelanggan }}</td>
                            <td>{{ $p->pekerjaan }}</td>
                            <td class="text-center">
                                <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-secondary">Belum ada data pelanggan. Silakan tambah melalui form di samping.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection