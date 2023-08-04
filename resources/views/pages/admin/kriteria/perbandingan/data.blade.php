@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($comparisons) }} --}}
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
        <div class="card col-lg-12">
            <div class="card-body table-responsive">
                @can('admin')
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalChoose">
                        <i class="fa-solid fa-clipboard-check"></i>
                        Kriteria
                    </button>
                @endcan
                <table class="table table-bordered table-responsive">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Dibuat Oleh</th>
                            <th>Kriteria</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($comparisons->count())
                            @foreach ($comparisons as $comparison)
                                <tr>
                                    {{-- $loop->iteraion => nomor / urutan loop keberapa nya --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $comparison->user->name }}</td>
                                    <td>
                                        @foreach ($comparison->details->unique('criteria_id_second') as $key => $detail)
                                            {{ $detail->criteria_name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $comparison->created_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <a href="{{ route('perbandingan.show', $comparison->id) }}"
                                            class="badge bg-success text-decoration-none">
                                            <i class="fa-solid fa-eye"></i>
                                            Perbandingan
                                        </a>
                                        @can('admin')
                                            <form action="{{ route('perbandingan.destroy', $comparison->id) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0 btnDelete"
                                                    data-object="perbandingan kriteria"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-danger text-center p-4">
                                    <h4>Belum ada data untuk perbandingan kriteria</h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal Choose Criteria -->
        <div class="modal fade" id="modalChoose" tabindex="-1" aria-labelledby="modalChooseLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalChooseLabel">Pilih Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('perbandingan.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" colspan="2">Nama Kriteria</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($criterias->count())
                                        @foreach ($criterias as $criteria)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    <input type="checkbox" value="{{ $criteria->id }}"
                                                        name="criteria_id[]">
                                                </th>
                                                <td>{{ $criteria->name }}</td>
                                                <td>{{ Str::ucfirst(Str::lower($criteria->kategori)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center text-danger" colspan="4">Tidak ditemukan kriteria</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
