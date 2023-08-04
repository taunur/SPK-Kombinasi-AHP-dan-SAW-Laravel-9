@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>
    </div>

    <div class="containter-fluid px-4 mt-3">
        <div class="row align-items-center">
            <form class="col-lg-8" method="POST" action="{{ route('kriteria.update', $criteria->id) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $criteria->name) }}" autofocus required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori"
                        required>
                        <option value="" disabled selected>Choose One</option>
                        <option value="BENEFIT" {{ old('kategori', $criteria->kategori) === 'BENEFIT' ? 'selected' : '' }}>
                            Benefit
                        </option>
                        <option value="COST" {{ old('kategori', $criteria->kategori) === 'COST' ? 'selected' : '' }}>Cost
                        </option>
                    </select>

                    @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        name="keterangan" value="{{ old('keterangan', $criteria->keterangan) }}" autofocus required>

                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
                <a href="/dashboard/kriteria" class="btn btn-danger mb-3">Cancel</a>
            </form>

            <div class="col-lg-4 card mb-5" style="height: 50%">
                <p> Kriteria yang telah ditentukan dibagi menjadi dua kategori, yaitu:</p>
                <ol>
                    <li>
                        <b> Benefit (keuntungan) : </b> semakin tinggi nilai keuntungannya maka semakin tinggi peluang untuk
                        dipilih
                        sebagai
                        siswa berprestasi.
                    </li>
                    <li>
                        <b> Cost (biaya): </b> semakin tinggi nilai cost maka semakin rendah peluang untuk dipilih sebagai
                        siswa
                        berprestasi.
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
