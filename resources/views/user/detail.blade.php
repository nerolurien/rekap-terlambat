@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Back button and page title -->
    <div class="d-flex align-items-center mt-4 mb-3">
        <a href="{{ route('user.manage') }}" class="btn btn-sm btn-outline-secondary me-3">
            <i class="mdi mdi-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fs-3 fw-bold text-dark m-0">Detail User</h2>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User Detail Card -->
    <div class="row">
        <div class="col-lg-4 col-md-5 mb-4">
            <!-- Profile Card -->
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        <div class="avatar-wrapper mx-auto mb-3" style="width: 120px; height: 120px;">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle border" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        <span class="badge rounded-pill bg-{{ $user->role == 'Admin' ? 'primary' : 'secondary' }} mb-3">
                            {{ $user->role }}
                        </span>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-email-outline me-1"></i> {{ $user->email }}
                        </p>
                        @if($user->phone)
                            <p class="text-muted">
                                <i class="mdi mdi-phone-outline me-1"></i> {{ $user->phone }}
                            </p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-primary me-2">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="mdi mdi-trash-can me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-7 mb-4">
            <!-- Detailed Information Card -->
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Informasi Pengguna</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-group">
                                <p class="text-muted small mb-1">Nama Lengkap</p>
                                <p class="fw-medium mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <p class="text-muted small mb-1">Email</p>
                                <p class="fw-medium mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-group">
                                <p class="text-muted small mb-1">Role</p>
                                <p class="fw-medium mb-0">{{ $user->role }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-group">
                                <p class="text-muted small mb-1">Tanggal Registrasi</p>
                                <p class="fw-medium mb-0">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <p class="text-muted small mb-1">Terakhir Diperbarui</p>
                                <p class="fw-medium mb-0">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="mdi mdi-alert-circle text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center">Apakah Anda yakin ingin menghapus user <strong>{{ $user->name }}</strong>?</p>
                    <p class="text-center text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection
