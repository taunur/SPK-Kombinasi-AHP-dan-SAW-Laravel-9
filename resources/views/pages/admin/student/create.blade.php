@extends('layouts.admin')

{{-- @dd($kelases) --}}

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $title }}</li>
            <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
        </ol>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('student.index') }}"
        enctype="multipart/form-data">
        @csrf
        {{-- nis --}}
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="number" id="nis" name="nis" maxlength="10"
                class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{ old('nis') }}" autofocus
                required placeholder="Masukan nis">

            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        {{-- nama siswa --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama siswa</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" autofocus required placeholder="Nama lengkap">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label for="name" class="form-label">Jenis Kelamin</label>
            <div class="d-flex">
                <div class="form-check col-lg-6">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender"
                        id="gender" value="Laki-laki">
                    <label class="form-check-label" for="gender1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check col-lg-6">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender"
                        id="gender" value="Perempuan">
                    <label class="form-check-label" for="gender2">
                        Perempuan
                    </label>
                </div>
            </div>

            @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- kelas --}}
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select class="form-select @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                <option value="" disabled selected>Pilih kelas</option>
                @foreach ($kelases as $kelas)
                    @if (old('kelas_id') == $kelas->id)
                        <option value="{{ $kelas->id }}" selected>{{ $kelas->kelas_name }}</option>
                    @else
                        <option value="{{ $kelas->id }}">{{ $kelas->kelas_name }}</option>
                    @endif
                @endforeach
            </select>

            @error('kelas_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        <a href="{{ route('student.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
