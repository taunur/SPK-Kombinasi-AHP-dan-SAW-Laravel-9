@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href={{ route('dashboard.index') }}>Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card col-lg-12">
            <div class="card-body">
                <div class="row justify-content-between">
                    <form class="col-lg-8 border-end pe-4" method="POST"
                        action="{{ route('profile.update', $userData->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <h4 class="mb-3">Pengaturan Profil</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $userData->name }}" autofocus required
                                placeholder="Masukan nama lengkap">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ $userData->username }}" required
                                placeholder="Masukan username">

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ $userData->email }}" required placeholder="example@example.com">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-3 mt-1">Simpan Perubahan Profile</button>
                    </form>

                    {{-- Ubah Password --}}
                    <form class="col-lg-4 ps-4" action="{{ route('profile.update', $userData->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div>
                            <h4 class="mb-3">Ubah Password</h4>
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Password Lama</label>
                                <input type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                                    id="oldPassword" name="oldPassword" required placeholder="Input password lama">

                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="myInput" name="password" required placeholder="Masukan password"
                                        aria-describedby="basic-addon2">
                                    <div class="align-items-center">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa-solid fa-eye-slash pointer" id="hidden"
                                                onclick="myFunction()"></i>
                                            &nbsp
                                            <i class="fa-solid fa-eye pointer" id="showed" onclick="myFunction()"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <div class="text-danger">
                                        <small> {{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" required
                                        placeholder="Konfirmasi password" aria-describedby="basic-addon2">
                                    <div class="align-items-center">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa-solid fa-eye-slash pointer" id="hide"
                                                onclick="myFunction2()"></i>
                                            &nbsp
                                            <i class="fa-solid fa-eye pointer" id="show" onclick="myFunction2()"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <div class="text-danger">
                                        <small> {{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">Perbarui Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
