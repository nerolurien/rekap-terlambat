@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid p-0 mt-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <h4 class="fw-bold text-primary mb-0">
                <i class="mdi mdi-clock-alert me-2"></i>Data Keterlambatan
            </h4>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('ps.export.lates') }}" class="btn btn-success rounded-pill shadow-sm">
                    <i class="mdi mdi-download"></i> <span class="d-none d-sm-inline">Export</span>
                </a>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs nav-fill border-bottom flex-column flex-sm-row" id="keterlambatanTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-medium" id="data-tab" data-bs-toggle="tab"
                        data-bs-target="#data" type="button" role="tab"
                        aria-controls="data" aria-selected="true">
                    <i class="mdi mdi-table me-1"></i>Keseluruhan Data
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-medium" id="rekap-tab" data-bs-toggle="tab"
                        data-bs-target="#rekap" type="button" role="tab"
                        aria-controls="rekap" aria-selected="false">
                    <i class="mdi mdi-chart-bar me-1"></i>Rekapitulasi Data
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="keterlambatanTabContent">
            <!-- Tab 1: Keseluruhan Data -->
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="mdi mdi-format-list-bulleted me-1"></i>Daftar Keterlambatan
                            </h5>

                            <div class="d-flex gap-2 align-items-center">
                                <form class="input-group" role="search" action="{{ route('ps.terlambat.index') }}" method="GET" style="width: 280px;">
                                    <input type="search" class="form-control" name="search" placeholder="Cari siswa..." aria-label="Search" value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="tableFilters">
                        <div class="card-body border-bottom pt-0">
                            <div class="row g-3 py-2">
                                <div class="col-12 col-md-4">
                                    <label class="form-label small">Tanggal</label>
                                    <input type="date" class="form-control form-control-sm" placeholder="Pilih tanggal">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label small">Nama Siswa</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Cari nama siswa">
                                </div>
                                <div class="col-12 col-md-4 d-flex align-items-end">
                                    <button class="btn btn-primary btn-sm">Filter</button>
                                    <button class="btn btn-light btn-sm ms-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableData" class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center d-none d-md-table-cell" width="5%">No</th>
                                        <th>Nama</th>
                                        <th class="d-none d-md-table-cell">Tanggal</th>
                                        <th class="d-none d-lg-table-cell">Informasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($lates->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-account-off fs-1"></i>
                                                <p class="mt-2">Data Pengguna Kosong</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($lates as $index => $lat)
                                            <tr>
                                                <td class="text-center d-none d-md-table-cell">{{ $lates->firstItem() + $index }}</td>
                                                <td class="fw-medium text-primary">
                                                    {{ $lat->student->name }}
                                                    <!-- Mobile only date display -->
                                                    <div class="d-md-none small text-muted">
                                                        <i class="mdi mdi-calendar me-1"></i>
                                                        {{ \Carbon\Carbon::parse($lat->date_time_late)->translatedFormat('d/m/Y H:i') }}
                                                    </div>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                                        <i class="mdi mdi-calendar me-1"></i>
                                                        {{ \Carbon\Carbon::parse($lat->date_time_late)->translatedFormat('l, d F Y H:i') }}
                                                    </span>
                                                </td>
                                                <td class="d-none d-lg-table-cell">
                                                    <div class="text-truncate" style="max-width: 250px;" data-bs-toggle="tooltip" title="{{ $lat->information ?? '-' }}">
                                                        {{ $lat->information ?? '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end justify-content-md-center flex-wrap gap-1">
                                                        <!-- Mobile info button -->
                                                        <button type="button" class="btn btn-sm btn-soft-info d-lg-none rounded-pill"
                                                                data-bs-toggle="modal" data-bs-target="#infoModal{{ $lat->id }}">
                                                            <i class="mdi mdi-information-outline"></i>
                                                        </button>

                                                        <a href="{{ route('terlambat.edit', $lat->id) }}" class="btn btn-sm btn-soft-primary rounded-pill" data-bs-toggle="tooltip" title="Edit">
                                                            <i class="mdi mdi-pencil"></i><span class="d-none d-sm-inline ms-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-soft-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $lat->id }}" title="Hapus">
                                                            <i class="mdi mdi-trash-can"></i><span class="d-none d-sm-inline ms-1">Hapus</span>
                                                        </button>

                                                        <!-- Mobile Info Modal -->
                                                        <div class="modal fade" id="infoModal{{ $lat->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detail Keterlambatan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="fw-bold">Nama Siswa:</label>
                                                                            <p>{{ $lat->name }}</p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="fw-bold">Tanggal & Waktu:</label>
                                                                            <p>{{ \Carbon\Carbon::parse($lat->date_time_late)->translatedFormat('l, d F Y H:i') }}</p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="fw-bold">Keterangan:</label>
                                                                            <p>{{ $lat->information ?? '-' }}</p>
                                                                        </div>
                                                                        @if(isset($lat->bukti))
                                                                        <div>
                                                                            <label class="fw-bold">Bukti:</label>
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('storage/' . $lat->bukti) }}" class="img-fluid rounded" alt="Bukti">
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Delete Confirmation Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $lat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $lat->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h5 class="modal-title text-danger" id="deleteModalLabel{{ $lat->id }}">
                                                                            <i class="mdi mdi-alert-circle me-1"></i>Konfirmasi
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center pb-4">
                                                                        <i class="mdi mdi-alert-circle text-warning" style="font-size: 4rem;"></i>
                                                                        <p class="fs-5 mt-3">Hapus data keterlambatan</p>
                                                                        <p class="fs-6 fw-bold text-primary">{{ $lat->name }}</p>
                                                                        <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                                                                    </div>
                                                                    <div class="modal-footer border-top-0 pt-0 justify-content-center">
                                                                        <button type="button" class="btn btn-light btn-sm rounded-pill" data-bs-dismiss="modal">
                                                                            <i class="mdi mdi-close me-1"></i>Batal
                                                                        </button>
                                                                        <form action="{{ route('terlambat.destroy', $lat->id) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                                                                <i class="mdi mdi-delete me-1"></i>Hapus
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if(!$lates->isEmpty())
                        <div class="d-flex justify-content-end mt-3">
                            {{ $lates->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tab 2: Rekapitulasi Data -->
            <div class="tab-pane fade" id="rekap" role="tabpanel" aria-labelledby="rekap-tab">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="mdi mdi-chart-box me-1"></i>Rekapitulasi Keterlambatan
                        </h5>
                        <form class="input-group" role="search" action="{{ route('ps.terlambat.index') }}" method="GET" style="width: 280px;">
                            <input type="search" class="form-control" name="search" placeholder="Cari siswa..." aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableRekap" class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center d-none d-md-table-cell" width="5%">No</th>
                                        <th class="d-none d-md-table-cell">NIS</th>
                                        <th>Nama</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rekap->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-account-off fs-1"></i>
                                                <p class="mt-2">Data Rekap Kosong</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($rekap as $index => $data)
                                            <tr>
                                                <td class="text-center d-none d-md-table-cell">{{ $index + 1 }}</td>
                                                <td class="d-none d-md-table-cell">
                                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                                        {{ $data->student->nis }}
                                                    </span>
                                                </td>
                                                <td class="fw-medium text-primary">
                                                    {{ $data->student->name }}
                                                    <!-- Mobile only NIS display -->
                                                    <div class="d-md-none small text-muted">
                                                        NIS: {{ $data->student->nis }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="position-relative">
                                                        <span class="badge bg-{{ $data->total_late >= 3 ? 'danger' : ($data->total_late >= 2 ? 'warning' : 'success') }} rounded-pill px-3 py-2">
                                                            {{ $data->total_late }} kali
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end justify-content-md-center flex-wrap gap-1">
                                                        <a href="{{ route('ps.terlambat.show', $data->student_id) }}" type="button"
                                                            class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                            title="Detail">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        @if ($data->total_late >= 3)
                                                        <a href="{{ route('ps.terlambat.cetak', $data->student_id) }}" class="btn btn-sm btn-danger rounded-pill" type="button">
                                                            <i class="mdi mdi-file-document"></i><span class="d-none d-sm-inline ms-1">Cetak Surat</span>
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <!-- Pagination -->
                        @if(!$lates->isEmpty())
                        <div class="d-flex justify-content-end mt-3">
                            {{ $lates->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Responsive table styles */
    @media (max-width: 576px) {
        .table-responsive {
            border: 0;
            margin-bottom: 0;
        }

        .table thead {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .table tbody tr {
            display: block;
            margin-bottom: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .table td {
            display: block;
            text-align: right;
            position: relative;
            padding: 0.5rem 0.5rem;
            border-top: 0;
        }
    }

    /* Global responsive adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 0 0.75rem;
        }

        .card-body {
            padding: 1rem;
        }

        .table thead th, .table tbody td {
            padding: 0.5rem;
        }

        .pagination {
            --bs-pagination-padding-x: 0.5rem;
            --bs-pagination-padding-y: 0.25rem;
            --bs-pagination-font-size: 0.875rem;
        }

        .badge {
            font-size: 0.7rem;
        }
    }

    /* Button styles */
    .btn-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: none;
    }

    .btn-soft-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-soft-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
    }

    .btn-soft-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .btn-soft-info {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
        border: none;
    }

    .btn-soft-info:hover {
        background-color: #0dcaf0;
        color: white;
    }

    /* Table styling */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    /* Navigation tabs styling */
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #0d6efd;
        color: #0d6efd;
        background-color: transparent;
        border-left: none;
        border-right: none;
        border-top: none;
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }

    .nav-tabs .nav-link:hover:not(.active) {
        border-bottom: 2px solid #e9ecef;
        color: #0d6efd;
    }

    /* Table header styling */
    .table thead th {
        font-weight: 600;
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }

    /* Card styling */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Custom DataTables styling for mobile */
    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.4rem;
            margin: 0 0.1rem;
        }
    }

    /* Custom DataTables styling */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 50rem;
        padding: 0.375rem 1rem;
        border: 1px solid #ced4da;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 50rem;
        padding: 0.375rem 2rem 0.375rem 1rem;
        border: 1px solid #ced4da;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50rem !important;
        padding: 0.25rem 0.5rem;
        margin: 0 0.2rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0d6efd;
        color: white !important;
        border: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd !important;
        border: none;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // DataTable responsive configuration
        const isSmallScreen = window.innerWidth < 768;

        // DataTable configuration
        const dataTableOptions = {
            responsive: true,
            autoWidth: false,
            language: {
                search: "<i class='mdi mdi-magnify me-1'></i>Cari:",
                lengthMenu: "<i class='mdi mdi-menu me-1'></i>_MENU_ data",
                zeroRecords: "<i class='mdi mdi-alert-circle me-1'></i>Tidak ada data",
                info: "<i class='mdi mdi-information me-1'></i>_START_ - _END_ dari _TOTAL_",
                infoEmpty: "<i class='mdi mdi-alert-circle-outline me-1'></i>Kosong",
                infoFiltered: "(dari _MAX_)",
                paginate: {
                    first: "<i class='mdi mdi-chevron-double-left'></i>",
                    last: "<i class='mdi mdi-chevron-double-right'></i>",
                    next: "<i class='mdi mdi-chevron-right'></i>",
                    previous: "<i class='mdi mdi-chevron-left'></i>"
                }
            },
            dom: isSmallScreen ?
                '<"row g-2"<"col-12"f>><"table-responsive my-2"t><"row align-items-center g-2"<"col-12 text-center"i><"col-12"p>>' :
                '<"row g-2"<"col-md-6"l><"col-md-6"f>><"table-responsive my-3"t><"row align-items-center g-2"<"col-md-6"i><"col-md-6"p>>',
            pageLength: isSmallScreen ? 5 : 10,
            lengthMenu: isSmallScreen ?
                [[5, 10, 25], [5, 10, 25]] :
                [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            drawCallback: function(settings) {
                // Reinitialize tooltips after draw
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        };

        // Initialize DataTables
        $('#tableData').DataTable(dataTableOptions);
        $('#tableRekap').DataTable(dataTableOptions);

        // Activate tab based on URL hash if present
        let hash = window.location.hash;
        if (hash) {
            $(`#keterlambatanTabs button[data-bs-target="${hash}"]`).tab('show');
        }

        // Update URL hash when tab changes
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            window.location.hash = $(e.target).data('bs-target');
        });

        // Handle window resize for responsive changes
        $(window).resize(function() {
            if (window.innerWidth < 768 && !isSmallScreen) {
                location.reload();
            } else if (window.innerWidth >= 768 && isSmallScreen) {
                location.reload();
            }
        });
    });
</script>
@endpush

@endsection
