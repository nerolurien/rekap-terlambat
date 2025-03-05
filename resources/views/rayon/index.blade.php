@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Success/Error Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-check-circle fs-4 me-2"></i>
                <div>
                    <strong>Berhasil!</strong>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-alert-circle fs-4 me-2"></i>
                <div>
                    <strong>Error!</strong>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-orange bg-gradient text-white shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fs-3 fw-bold mb-1">Data Rayon</h2>
                            <p class="mb-0 opacity-75">Manajemen data wilayah pembinaan siswa</p>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="mdi mdi-map-marker-radius fs-1 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <!-- Action Bar -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <a href="{{ route('rayon.create') }}" class="btn btn-orange px-4">
                            <i class="mdi mdi-plus me-2"></i> Tambah Rayon
                        </a>

                        <div class="d-flex gap-2 align-items-center">
                            <form class="input-group" role="search" action="{{ route('rayon.index') }}" method="GET" style="width: 280px;">
                                <input type="search" class="form-control" name="search" placeholder="Cari rayon..." aria-label="Search" value="{{ request('search') }}">
                                <button class="btn btn-outline-orange" type="submit">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Table Section With Card -->
                    <div class="card border shadow-none bg-light">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-white">
                                        <tr>
                                            <th class="text-center py-3" style="width: 5%;">#</th>
                                            <th style="width: 20%">Nama Rayon</th>
                                            <th style="width: 20%">Pembimbing Siswa</th>
                                            <th class="text-center" style="width: 20%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rayon as $index => $rom)
                                            <tr>
                                                <td class="text-center">{{ $rayon->firstItem() + $index }}</td>
                                                <td class="fw-medium">{{ $rom->rayon }}</td>
                                                <td class="fw-medium">{{ $rom->user->name }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('rayon.edit', $rom->id) }}" class="btn btn-sm btn-orange" data-bs-toggle="tooltip" title="Edit Rayon">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $rom->id }}" title="Hapus Rayon">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $rom->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $rom->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 shadow">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $rom->id }}">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center p-4">
                                                                    <i class="mdi mdi-alert-circle-outline text-danger" style="font-size: 5rem;"></i>
                                                                    <h4 class="mt-3 mb-2">Apakah Anda yakin?</h4>
                                                                    <p class="mb-1">Anda akan menghapus rayon <strong>{{ $rom->rayon }}</strong></p>
                                                                    <p class="text-muted small">Tindakan ini tidak dapat dibatalkan dan mungkin memengaruhi data siswa terkait.</p>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                                        <i class="mdi mdi-close me-1"></i> Batal
                                                                    </button>
                                                                    <form action="{{ route('rayon.destroy', $rom->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="mdi mdi-trash-can me-1"></i> Ya, Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-muted">
                                                    <h5>Data Rayon Kosong</h5>
                                                    <p class="mb-0">Belum ada data rayon yang tersedia</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info & Pagination -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                        <div class="text-muted small mb-3 mb-md-0">
                            Menampilkan {{ $rayon->firstItem() ?? 0 }} sampai {{ $rayon->lastItem() ?? 0 }} dari {{ $rayon->total() }} data
                        </div>

                        <!-- Pagination -->
                        <div>
                            {{ $rayon->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-orange {
        background-color: #FF7F50;
        border-color: #FF7F50;
        color: white;
    }

    .btn-orange:hover, .btn-orange:focus {
        background-color: #FF6347;
        border-color: #FF6347;
        color: white;
    }

    .bg-orange {
        background-color: #FF7F50 !important;
    }

    .text-orange {
        color: #FF7F50 !important;
    }

    .btn-outline-orange {
        color: #FF7F50;
        border-color: #FF7F50;
    }

    .btn-outline-orange:hover {
        background-color: #FF7F50;
        border-color: #FF7F50;
        color: white;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body
            });
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection
