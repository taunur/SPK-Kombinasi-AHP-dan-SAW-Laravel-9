@extends('layouts.admin')

@section('content')
    <main>
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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- datatable --}}
            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <a href="{{ route('kriteria.create') }}" type="button" class="btn btn-primary mb-3"><i
                            class="fas fa-plus me-1"></i>Kriteria</a>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($criterias->count())
                                @foreach ($criterias as $criteria)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $criteria->name }}</td>
                                        <td>{{ Str::ucfirst(Str::lower($criteria->kategori)) }}</td>
                                        <td>{{ $criteria->keterangan }}</td>
                                        <td>
                                            <a href="{{ route('kriteria.edit', $criteria->id) }}"
                                                class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('kriteria.destroy', $criteria->id) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0 btnDelete" data-object="kriteria"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-danger text-center p-4">
                                        <h4>Kamu belum membuat kriteria</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
