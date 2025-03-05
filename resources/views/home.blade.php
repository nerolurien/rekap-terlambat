@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-check-circle fs-4 me-2"></i>
                    <strong>{{ session('success') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-alert-circle fs-4 me-2"></i>
                    <strong>{{ session('error') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Dashboard Overview</h4>
                        <p class="text-muted">Informasi ringkas tentang data sekolah</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Administrator Card -->
            @if (Auth::user()->role == 'admin')
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1">Administrator</h6>
                                    <h2 class="fw-bold mb-0">{{ $totalAdmin }}</h2>
                                </div>
                                <div class="icon-shape bg-purple bg-opacity-10 rounded-circle p-3">
                                    <i class="lni lni-user text-purple fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3 mb-0">
                                <span class="badge bg-light text-dark">
                                    <i class="lni lni-users me-1"></i> Pengelola Sistem
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-purple bg-opacity-10 border-0 py-3">
                            <a href={{ route('user.manage') }}
                                class="text-purple text-decoration-none d-flex align-items-center justify-content-center">
                                <span>Lihat Detail</span>
                                <i class="lni lni-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pembimbing Siswa Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1">Pembimbing Siswa</h6>
                                    <h2 class="fw-bold mb-0">{{ $totalPS }}</h2>
                                </div>
                                <div class="icon-shape bg-orange bg-opacity-10 rounded-circle p-3">
                                    <i class="lni lni-user text-orange fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3 mb-0">
                                <span class="badge bg-light text-dark">
                                    <i class="lni lni-consulting me-1"></i> Staf Pengajar
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-orange bg-opacity-10 border-0 py-3">
                            <a href={{ route('user.manage') }}
                                class="text-orange text-decoration-none d-flex align-items-center justify-content-center">
                                <span>Lihat Detail</span>
                                <i class="lni lni-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Peserta Didik Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1">Peserta Didik</h6>
                                    <h2 class="fw-bold mb-0">{{ $totalSiswa }}</h2>
                                </div>
                                <div class="icon-shape bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="lni lni-user text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3 mb-0">
                                <span class="badge bg-light text-dark">
                                    <i class="lni lni-graduation me-1"></i> Siswa Aktif
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-success bg-opacity-10 border-0 py-3">
                            <a href={{ route('siswa.index') }}
                                class="text-success text-decoration-none d-flex align-items-center justify-content-center">
                                <span>Lihat Detail</span>
                                <i class="lni lni-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Rombel Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1">Rombel</h6>
                                    <h2 class="fw-bold mb-0">{{ $totalRombel }}</h2>
                                </div>
                                <div class="icon-shape bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="lni lni-bookmark text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3 mb-0">
                                <span class="badge bg-light text-dark">
                                    <i class="lni lni-apartment me-1"></i> Kelompok Belajar
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-primary bg-opacity-10 border-0 py-3">
                            <a href={{ route('rombel.manage') }}
                                class="text-primary text-decoration-none d-flex align-items-center justify-content-center">
                                <span>Lihat Detail</span>
                                <i class="lni lni-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Rayon Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-1">Rayon</h6>
                                    <h2 class="fw-bold mb-0">{{ $totalRayon }}</h2>
                                </div>
                                <div class="icon-shape bg-orange bg-opacity-10 rounded-circle p-3">
                                    <i class="lni lni-bookmark text-orange fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3 mb-0">
                                <span class="badge bg-light text-dark">
                                    <i class="lni lni-map me-1"></i> Wilayah Pembinaan
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-orange bg-opacity-10 border-0 py-3">
                            <a href={{ route('rayon.index') }}
                                class="text-orange text-decoration-none d-flex align-items-center justify-content-center">
                                <span>Lihat Detail</span>
                                <i class="lni lni-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
        @endif
        @if (Auth::user()->role == 'ps')
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Peserta Didik Rayon {{ $namaRayon }}<h6>
                            <h2 class="fw-bold mb-0">{{ $jumlahSiswaPerRayon }}</h2>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="lni lni-bookmark text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary bg-opacity-10 border-0 py-3">
                    <a href={{ route('ps.siswa.index') }}
                        class="text-primary text-decoration-none d-flex align-items-center justify-content-center">
                        <span>Lihat Detail</span>
                        <i class="lni lni-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Keterlambatan {{ $namaRayon }} Hari ini<h6>
                            <p>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
                            <h2 class="fw-bold mb-0">{{ $jumlahTerlambat }}</h2>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="lni lni-bookmark text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary bg-opacity-10 border-0 py-3">
                    <a href={{ route('ps.siswa.index') }}
                        class="text-primary text-decoration-none d-flex align-items-center justify-content-center">
                        <span>Lihat Detail</span>
                        <i class="lni lni-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Additional Info Section (Optional) -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Terbaru</h5>
                        <p class="card-text text-muted">Sistem informasi sekolah diperbarui terakhir pada
                            {{ date('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
