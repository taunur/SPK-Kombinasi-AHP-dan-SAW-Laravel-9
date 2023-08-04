@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($details) }} --}}
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('perbandingan.index') }}">Perbandingan Kriteria</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive col-lg-12">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="text-center">Kriteria Pertama</th>
                                <th scope="col" class="text-center">Intensitas Kepentingan</th>
                                <th scope="col" class="text-center">Kriteria Kedua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($details))
                                <form action="{{ route('perbandingan.update', $details[0]->criteria_analysis_id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $details[0]->criteria_analysis_id }}">
                                    @foreach ($details as $detail)
                                        <tr>
                                            <input type="hidden" name="criteria_analysis_detail_id[]"
                                                value="{{ $detail->id }}">
                                            <td class="text-center">
                                                {{ $detail->firstCriteria->name }}
                                            </td>
                                            <td class="text-center">
                                                <select class="form-select" name="comparison_values[]" required>
                                                    <option value="" disabled selected>--Pilih Nilai--</option>
                                                    <option value="1"
                                                        {{ $detail->comparison_value == 1 ? 'selected' : '' }}>
                                                        1 - Sama Pentingnya
                                                    </option>
                                                    <option value="2"
                                                        {{ $detail->comparison_value == 2 ? 'selected' : '' }}>
                                                        2 - Mendekati sedikit lebih penting
                                                    </option>
                                                    <option value="3"
                                                        {{ $detail->comparison_value == 3 ? 'selected' : '' }}>
                                                        3 - Sedikit lebih penting
                                                    </option>
                                                    <option value="4"
                                                        {{ $detail->comparison_value == 4 ? 'selected' : '' }}>
                                                        4 - Mendekati lebih penting
                                                    </option>
                                                    <option value="5"
                                                        {{ $detail->comparison_value == 5 ? 'selected' : '' }}>
                                                        5 - Lebih penting
                                                    </option>
                                                    <option value="6"
                                                        {{ $detail->comparison_value == 6 ? 'selected' : '' }}>
                                                        6 - Mendekati sangat penting
                                                    </option>
                                                    <option value="7"
                                                        {{ $detail->comparison_value == 7 ? 'selected' : '' }}>
                                                        7 - Sangat penting
                                                    </option>
                                                    <option value="8"
                                                        {{ $detail->comparison_value == 8 ? 'selected' : '' }}>
                                                        8 - Mendekati mutlak sangat penting
                                                    </option>
                                                    <option value="9"
                                                        {{ $detail->comparison_value == 9 ? 'selected' : '' }}>
                                                        9 - Mutlak sangat penting
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->secondCriteria->name }}
                                            </td>
                                        </tr>
                                    @endforeach


                                    <div class="col-lg-12">
                                        @can('admin')
                                            <form action="{{ route('perbandingan.update', $criteria_analysis) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn mb-3 ml-4 btn-primary">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    Simpan
                                                </button>
                                            @endcan
                                            @if ($isDoneCounting)
                                                <a href="{{ route('perbandingan.result', $criteria_analysis->id) }}"
                                                    class="btn btn-success mb-3">
                                                    <i class="fa-solid fa-eye"></i>
                                                    Hasil
                                                </a>
                                            @else
                                                <a class="btn btn-success disabled mb-3">
                                                    <i class="fa-solid fa-eye"></i>
                                                    Operator belum menyimpan kriteria
                                                </a>
                                            @endif
                                    </div>
                                </form>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
