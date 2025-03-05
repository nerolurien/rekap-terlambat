@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">Edit Akun</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-write"></i></span>
                                <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                    placeholder="NIS" id="nis" name="nis" value="{{ old('nis', $siswa->nis ?? '') }}">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nama" id="name" name="name" value="{{ old('name', $siswa->name ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rombel</label>
                            <select class="form-select @error('rombel_id') is-invalid @enderror" name="rombel_id">
                                <option value="">-- Pilih Rombel --</option>
                                @foreach ($rombel as $rombel)
                                    <option value="{{ $rombel->id }}" {{ old('rombel_id', $siswa->rombel_id ?? '') == $rombel->id ? 'selected' : '' }}>
                                        {{ $rombel->rombel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rombel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rayon</label>
                            <select class="form-select @error('rayon_id') is-invalid @enderror" name="rayon_id">
                                <option value="">-- Pilih Rayon --</option>
                                @foreach ($rayon as $rayon)
                                    <option value="{{ $rayon->id }}" {{ old('rayon_id', $siswa->rayon_id ?? '') == $rayon->id ? 'selected' : '' }}>
                                        {{ $rayon->rayon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rayon_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
