@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-4">
    <!-- Header -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card border-0 bg-primary bg-gradient text-white shadow">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="mb-3 mb-md-0">
                            <h2 class="fs-4 fs-md-3 fw-bold mb-1">Detail Keterlambatan</h2>
                            <p class="mb-0 opacity-75 small">Informasi lengkap riwayat keterlambatan siswa</p>
                        </div>
                        <div class="bg-white bg-opacity-25 p-2 p-md-3 rounded-circle align-self-start align-self-md-center">
                            <i class="mdi mdi-clock-alert fs-3 fs-md-1 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            @if($terlambat->isNotEmpty())
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-2 py-md-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <h5 class="card-title mb-2 mb-md-0 text-primary">
                                <i class="mdi mdi-account me-2"></i>{{ $terlambat->first()->student ? $terlambat->first()->student->name : 'Data tidak ditemukan' }}
                            </h5>
                            <span class="badge bg-primary align-self-start align-self-md-center">{{ $terlambat->count() }} keterlambatan</span>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="d-none d-sm-block"> <!-- Hanya tampil di layar >=576px -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th width="30%">Tanggal & Waktu</th>
                                            <th width="50%">Keterangan</th>
                                            <th width="15%" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($terlambat as $index => $data)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-1 p-md-2 me-2">
                                                        <i class="mdi mdi-calendar-clock text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold small">{{ \Carbon\Carbon::parse($data->date_time_late)->format('d M Y') }}</div>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($data->date_time_late)->format('H:i') }} WIB</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="small text-wrap">{{ $data->information }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark">Terlambat</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mobile View (Hanya tampil di layar <576px) -->
                        <div class="d-block d-sm-none">
                            @foreach ($terlambat as $index => $data)
                            <div class="p-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">#{{ $index + 1 }}</div>
                                    <span class="badge bg-warning text-dark">Terlambat</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-light rounded-circle p-1 me-2">
                                        <i class="mdi mdi-calendar-clock text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($data->date_time_late)->format('d M Y') }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($data->date_time_late)->format('H:i') }} WIB</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Keterangan:</small>
                                    <p class="mb-0 small">{{ $data->information }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="card-footer bg-white">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <small class="text-muted mb-2 mb-md-0">Diperbarui terakhir: {{ now()->format('d M Y H:i') }}</small>
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary align-self-start align-self-md-center">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow-sm border-0">
                    <div class="card-body py-4 py-md-5">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="mdi mdi-check-circle text-success" style="font-size: 3rem; font-size: min(4rem, 15vw);"></i>
                            </div>
                            <h4 class="text-muted">Tidak Ada Data Keterlambatan</h4>
                            <p class="mb-4">Siswa ini tidak memiliki riwayat keterlambatan yang tercatat.</p>
                            <a href="{{ url()->previous() }}" class="btn btn-primary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
