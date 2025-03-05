@extends('layouts.app', ['title'])
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">
                    <h6 class="mb-3 fw-bold">Edit Rombel</h6>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('rombel.update', $rombel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Rombel</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-bookmark"></i></span>
                                <input type="text" class="form-control @error('rombel') is-invalid @enderror" placeholder="Rombel" id="rombel" name="rombel"
                                    value="{{ old('rombel', $rombel->rombel) }}">
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rombel.manage') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection
