@extends('layouts.app', ['title'])
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">
                    <h6 class="mb-3 fw-bold">Edit rayon</h6>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('rayon.update', $rayon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Rayon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-bookmark"></i></span>
                                <input type="text" class="form-control @error('rayon') is-invalid @enderror" placeholder="rayon" id="rayon" name="rayon"
                                    value="{{ old('rayon', $rayon->rayon) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pembimbing Siswa</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">-- Pilih Pembimbing Siswa --</option>
                                @foreach ($pembimbingSiswa as $ps)
                                    <option value="{{ $ps->id }}" {{ old('user_id', $rayon->user_id ?? '') == $ps->id ? 'selected' : '' }}>
                                        {{ $ps->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rayon.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-orange">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            .btn-orange {
                background-color: #FF7F50;
                border-color: #FF7F50;
                color: white;
            }
        </style>

    @endsection
