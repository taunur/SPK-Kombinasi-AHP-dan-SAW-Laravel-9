@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <a href="{{ route('users.create') }}" type="button" class="btn btn-primary mb-3"><i
                            class="fas fa-plus me-1"></i>Pengguna</a>
                    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="ms-auto">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control" required>
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-upload"></i>
                                Pengguna
                            </button>
                        </div>
                    </form>
                </div>

                {{-- validate req field --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- file request --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <table id="datatablesSimple" class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count())
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->username }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->level }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="badge bg-warning"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0 btnDelete" data-object="siswa"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-danger text-center p-4">
                                    <h4>Operator belum membuat pengguna</h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
