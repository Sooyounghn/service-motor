<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoCare Pro — Sistem Manajemen Service Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #e2e8f0;
        }
        .navbar-custom {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #1e293b;
        }
        .nav-pill-custom {
            color: #94a3b8;
            border-radius: 10px;
            padding: 0.55rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .nav-pill-custom:hover {
            color: #f8fafc;
            background-color: #1e293b;
        }
        .nav-pill-custom.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #090d16 !important;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25);
        }
        .card-modern {
            background-color: #111827;
            border: 1px solid #1f2937;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
        }
        .card-header-modern {
            background-color: rgba(30, 41, 59, 0.45);
            border-bottom: 1px solid #1f2937;
            padding: 1.1rem 1.4rem;
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
        }
        .form-control, .form-select {
            background-color: #0f172a;
            border: 1px solid #334155;
            color: #f1f5f9;
            border-radius: 10px;
            padding: 0.6rem 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0f172a;
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.2);
            color: #fff;
        }
        .form-readonly-auto {
            background-color: #1e293b !important;
            border: 1px dashed #f59e0b !important;
            color: #fbbf24 !important;
            font-weight: 600;
        }
        .radio-card {
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
        }
        .radio-card:hover {
            border-color: #f59e0b;
        }
        .btn-amber {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            color: #090d16;
            font-weight: 700;
            border-radius: 10px;
            padding: 0.65rem 1.2rem;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-amber:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #090d16;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(245, 158, 11, 0.3);
        }
        .table-modern thead th {
            background-color: #1e293b;
            color: #94a3b8;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #334155;
            padding: 0.9rem 1rem;
        }
        .table-modern tbody td {
            border-bottom: 1px solid #1f2937;
            padding: 0.9rem 1rem;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top mb-4 py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ route('pelanggan.index') }}">
                <span class="bg-warning text-dark rounded-3 px-2 py-1 d-inline-flex align-items-center">
                    <i class="bi bi-wrench-adjustable-circle-fill fs-5"></i>
                </span>
                <span>MotoCare <span class="text-warning">Service</span></span>
            </a>
            <div class="d-flex flex-wrap gap-2 mt-2 mt-lg-0">
                <a class="nav-link nav-pill-custom {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
                    <i class="bi bi-people-fill me-1"></i> Data Pelanggan
                </a>
                <a class="nav-link nav-pill-custom {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                    <i class="bi bi-bicycle me-1"></i> Data Kendaraan
                </a>
                <a class="nav-link nav-pill-custom {{ request()->routeIs('daftar-service.*') ? 'active' : '' }}" href="{{ route('daftar-service.index') }}">
                    <i class="bi bi-clipboard2-plus-fill me-1"></i> Daftar Service
                </a>
                <a class="nav-link nav-pill-custom {{ request()->routeIs('data-service.*') ? 'active' : '' }}" href="{{ route('data-service.index') }}">
                    <i class="bi bi-tools me-1"></i> Data Service
                </a>
                <a class="nav-link nav-pill-custom {{ request()->routeIs('pembayaran-service.*') ? 'active' : '' }}" href="{{ route('pembayaran-service.index') }}">
                    <i class="bi bi-wallet2 me-1"></i> Pembayaran
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success bg-success-subtle border-success text-success-emphasis rounded-3 d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger bg-danger-subtle border-danger text-danger-emphasis rounded-3 mb-4">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Periksa kembali inputan Anda:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>