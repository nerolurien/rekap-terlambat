@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Success/Error Alerts -->
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

        <div class="row my-4">
            <div class="col-12">
                <h2 class="fs-3 fw-bold text-dark mb-4">Data User</h2>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm px-3 mb-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah User
                            </a>

                            <form class="input-group input-group-sm mb-2" role="search" action="{{ route('user.manage') }}"
                                method="GET" style="max-width: 250px;">
                                <input type="search" class="form-control" name="search" placeholder="Search..."
                                    aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center" style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-account-off fs-1"></i>
                                                <p class="mt-2">Data Pengguna Kosong</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="text-center">{{ $users->firstItem() + $index }}</td>
                                                <td class="fw-medium">{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge rounded-pill bg-{{ $user->role == 'Admin' ? 'primary' : 'secondary' }}">
                                                        {{ $user->role }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                            title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('user.show', $user->id) }}" type="button"
                                                            class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                            title="Detail">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <!-- Tombol untuk trigger modal hapus -->
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $user->id }}"
                                                            title="Hapus">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>

                                                        <!-- Modal Konfirmasi Hapus -->
                                                        <div class="modal fade" id="deleteModal{{ $user->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deleteModalLabel{{ $user->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $user->id }}">
                                                                            Konfirmasi Hapus</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="text-center mb-3">
                                                                            <i class="mdi mdi-alert-circle text-warning"
                                                                                style="font-size: 3rem;"></i>
                                                                        </div>
                                                                        <p class="text-center">Apakah Anda yakin ingin
                                                                            menghapus user
                                                                            <strong>{{ $user->name }}</strong>?
                                                                        </p>
                                                                        <p class="text-center text-muted small">Tindakan ini
                                                                            tidak dapat dibatalkan.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form
                                                                            action="{{ route('user.destroy', $user->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Ya, Hapus</button>
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

                        <!-- Pagination dengan info -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
                            <div class="text-muted small">
                                Menampilkan {{ $users->firstItem() ?? 0 }} hingga {{ $users->lastItem() ?? 0 }} dari
                                {{ $users->total() }} entri
                            </div>
                            <div>
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Auto-dismiss alert setelah 5 detik
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
