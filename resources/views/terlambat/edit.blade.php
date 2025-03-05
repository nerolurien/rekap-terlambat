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

                    <form action="{{ route('terlambat.update', $late->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Siswa</label>
                            <select class="form-select @error('student_id') is-invalid @enderror" name="student_id"
                                id="studentSelect">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswa as $sis)
                                    <option value="{{ $sis->id }}"
                                        {{ old('student_id', $late->student_id ?? '') == $sis->id ? 'selected' : '' }}>
                                        {{ $sis->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-calendar"></i></span>
                                <input type="datetime-local" class="form-control" name="date_time_late"
                                    value="{{ old('late', $late->date_time_late, date('Y-m-d\TH:i:s')) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan Keterlambatan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-pencil-alt"></i></span>
                                <textarea class="form-control" placeholder="Masukkan Keterangan" name="information" id="information" cols="4"
                                    rows="2">{{ old('late', $late->information) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bukti</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-image"></i></span>
                                <input type="file" class="form-control" name="bukti" id="bukti"
                                    onchange="previewImage(event)">
                            </div>
                            @error('bukti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <!-- Preview gambar -->
                            @if (isset($late->bukti))
                                <img id="imagePreview" src="{{ asset('storage/' . $late->bukti) }}" class="mt-2"
                                    width="200">
                            @else
                                <img id="imagePreview" class="mt-2" width="200" style="display: none;">
                            @endif
                        </div>


                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('terlambat.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            /* Agar Select2 sesuai dengan Bootstrap */
            .select2-container .select2-selection--single {
                height: calc(2.25rem + 2px);
                /* Sesuai tinggi input Bootstrap */
                border-radius: 0.375rem;
                /* Rounded border */
                padding: 0.375rem 0.75rem;
                border: 1px solid #ced4da;
                background-color: #fff;
            }
        </style>

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('imagePreview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            $(document).ready(function() {
                $('#studentSelect').select2({
                    theme: 'bootstrap-5', // Agar sesuai dengan Bootstrap 5
                    placeholder: "Cari siswa...",
                    allowClear: true
                });
            });
        </script>
    @endsection
