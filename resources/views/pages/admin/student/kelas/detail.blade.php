@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Kelas : {{ $kelas }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Data Siswa</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>

        {{-- datatable --}}
        <div class="card col-lg-10">
            <div class="card-body table-responsive">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama siswa</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($students->count())
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->nis }}</td>
                                    <td>{{ Str::ucfirst(Str::upper($student->name)) }}</td>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-danger text-center p-4">
                                    <h4>Belum ada data Siswa</h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
