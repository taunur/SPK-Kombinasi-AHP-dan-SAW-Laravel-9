@extends('layouts.admin')

{{-- @dd($kelases) --}}

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('student.update', $student->id) }}"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- nis --}}
        <div class="mb-3">
            <label for="nis" class="form-label">nis</label>
            <input type="number" id="nis" name="nis" maxlength="10"
                class="form-control @error('nis') is-invalid @enderror" id="nis"
                value="{{ old('nis', $student->nis) }}" autofocus required>

            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        {{-- nama --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama siswa</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $student->name) }}" autofocus required>

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
                    <input class="form-check-input @error('gender') is-invalid @enderror"
                        {{ $student->gender === 'Laki-laki' ? 'checked' : '' }} type="radio" name="gender" id="gender"
                        value="Laki-laki">
                    <label class="form-check-label" for="gender1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check col-lg-6">
                    <input class="form-check-input @error('gender') is-invalid @enderror"
                        {{ $student->gender === 'Perempuan' ? 'checked' : '' }} type="radio" name="gender" id="gender"
                        value="Perempuan">
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
            <select class="form-select" name="kelas_id">
                <option value="" disabled selected>Pilih kelas</option>
                @foreach ($kelases as $kelas)
                    @if (old('kelas_id', $student->kelas_id) == $kelas->id)
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

        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="{{ route('student.index') }}" class="btn btn-danger mb-3">Batal</a>
    </form>
@endsection
