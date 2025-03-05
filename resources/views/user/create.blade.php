@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">
                    <h6 class="mb-3 fw-bold">Tambah Akun</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Name" id="name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" id="password" name="password">
                                <span class="input-group-text" onclick="togglePasswordVisibility()"
                                    style="cursor: pointer;">
                                    <i id="eyeIcon" class="mdi mdi-eye-off"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Select Role -->
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" name="role">
                                <option value="">--Pilih Role--</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="ps" {{ old('role') == 'ps' ? 'selected' : '' }}>PS</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.manage') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function togglePasswordVisibility() {
                var passwordInput = document.getElementById("password");
                var eyeIcon = document.getElementById("eyeIcon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("mdi-eye-off");
                    eyeIcon.classList.add("mdi-eye"); // Mata terbuka
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("mdi-eye");
                    eyeIcon.classList.add("mdi-eye-off"); // Mata tertutup
                }
            }
        </script>
    @endsection
