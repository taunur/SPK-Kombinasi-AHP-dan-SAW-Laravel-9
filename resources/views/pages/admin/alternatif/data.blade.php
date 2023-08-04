@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($alternatives) }} --}}
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

                <div class="d-sm-flex align-items-center">
                    @can('admin')
                        <button type="button" class="btn btn-primary mb-3 me-auto" data-bs-toggle="modal"
                            data-bs-target="#addAlternativeModal">
                            <i class="fas fa-plus me-1"></i>
                            Alternatif
                        </button>

                        <form action="{{ route('alternatives.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="file" name="file" class="form-control" required>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-upload"></i>
                                    Nilai
                                </button>
                                <a class="btn btn-warning" href="{{ route('alternatives.export') }}">
                                    <i class="fa-solid fa-download"></i>
                                    Nilai
                                </a>
                            </div>
                        </form>
                    @endcan
                </div>

                {{-- error handle --}}
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

                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="d-sm-flex align-items-center mb-3">
                        <select class="form-select me-3" id="perPage" name="perPage" onchange="submitForm()">
                            @foreach ($perPageOptions as $option)
                                <option value="{{ $option }}" {{ $option == $perPage ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label col-lg-7 col-sm-7 col-md-7" for="perPage">entries per page</label>
                    </div>

                    <form action="{{ route('alternatif.index') }}" method="GET" class="ms-auto float-end">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="myInput" class="form-control" placeholder="Search..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>


                <table class="table table-bordered table-responsive">
                    <thead class="table-primary align-middle">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Alternatif</th>
                            <th class="text-center" rowspan="2">Kelas</th>
                            <th class="text-center" colspan="{{ $criterias->count() }}">Kriteria</th>
                            @can('admin')
                                <th class="text-center" rowspan="2">Aksi</th>
                            @endcan
                        </tr>
                        <tr>
                            @if ($criterias->count())
                                @foreach ($criterias as $criteria)
                                    <th class="text-center">{{ $criteria->name }}</th>
                                @endforeach
                            @else
                                <th class="text-center">No Criteria Data Found</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="myTable">
                        @if ($alternatives->count())
                            @foreach ($alternatives as $alternative)
                                <tr>
                                    {{-- <th>{{ $loop->iteration }}</th> --}}
                                    <td scope="row" class="text-center">
                                        {{ ($alternatives->currentpage() - 1) * $alternatives->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td>
                                        {{ Str::ucfirst(Str::upper($alternative->name)) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $alternative->kelas->kelas_name }}
                                    </td>
                                    @foreach ($criterias as $key => $value)
                                        @if (isset($alternative->alternatives[$key]))
                                            <td class="text-center">
                                                {{ floatval($alternative->alternatives[$key]->alternative_value) }}
                                            </td>
                                        @else
                                            <td class="text-center">
                                                Empty
                                            </td>
                                        @endif
                                    @endforeach
                                    @can('admin')
                                        <td class="text-center">
                                            <a href="{{ route('alternatif.edit', $alternative->id) }}"
                                                class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('alternatif.destroy', $alternative->id) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0 btnDelete" data-object="alternatif">
                                                    <i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ 5 + $criterias->count() }}" class="text-center text-danger">
                                    Belum ada data
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $alternatives->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Add Alternative -->
    <div class="modal fade" id="addAlternativeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addAlternativeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlternativeModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('alternatif.index') }}" method="post">
                    <div class="modal-body">
                        <span class="mb-2">Catatan :</span>
                        <ul class="list-group mb-2">
                            <li class="list-group-item bg-success text-white">
                                Nilai minimum 0 dan maximum 100
                            </li>
                            <li class="list-group-item bg-success text-white">
                                Gunakan (.) jika memasukan nilai desimal
                            </li>
                            <li class="list-group-item bg-warning text-black">
                                Masukan nilai rata-rata dari Semester 1 - 5
                            </li>
                        </ul>

                        {{-- @dd($student->kelas_id) --}}

                        @csrf
                        {{-- Pilih Student --}}
                        <div class="my-2">
                            <label for="student_id" class="form-label">Daftar Siswa</label>
                            <select class="form-select @error('student_id') 'is-invalid' : ''  @enderror" id="student_id"
                                name="student_id" required>
                                <option disabled selected value="">--Pilih Siswa--</option>
                                @if ($student_list->count())
                                    @foreach ($student_list as $kelas => $students)
                                        <optgroup label="Kelas {{ $kelas }}: {{ $students->count() }}">
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }} {{ $student->kelasId }}">
                                                    {{ $student->name }} - {{ $student->kelas->kelas_name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @else
                                    <option disabled selected>--NO DATA FOUND--</option>
                                @endif
                            </select>

                            @error('student_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Masukkan Nilai Kriteria --}}
                        @if ($criterias->count())
                            @foreach ($criterias as $key => $criteria)
                                <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}">

                                <div class="my-2">
                                    <label for="{{ str_replace(' ', '', $criteria->name) }}" class="form-label">
                                        Nilai <b> {{ $criteria->name }} </b>
                                    </label>
                                    <input type="text" id="{{ str_replace(' ', '', $criteria->name) }}"
                                        class="form-control @error('alternative_value') 'is-invalid' : '' @enderror"
                                        name="alternative_value[]" placeholder="Masukkan Nilai"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)|| event.charCode == 46)"
                                        maxlength="5" autocomplete="off" required>

                                    @error('alternative_value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="{{ $criterias->count() ? 'submit' : 'button' }}"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            var perPageSelect = document.getElementById('perPage');
            var perPageValue = perPageSelect.value;

            var currentPage = {{ $alternatives->currentPage() }};
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set('perPage', perPageValue);

            if (!params.has('page')) {
                params.set('page', currentPage);
            }

            url.search = params.toString();
            window.location.href = url.toString();
        }
    </script>
@endsection
