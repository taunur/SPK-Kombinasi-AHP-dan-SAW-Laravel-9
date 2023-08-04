@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($normalizations) }} --}}
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('rank.index') }}">Final Ranking</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    @php($crValue = session("cr_value_{$criteriaAnalysis->id}"))
                    @if ($crValue > 0.1)
                        <li class="breadcrumb-item" style="color: red;">
                            Rangking Siswa
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ route('rank.final', $criteriaAnalysis->id) }}">
                                Rangking Siswa
                            </a>
                        </li>
                    @endif
                    @if ($crValue > 0.1)
                        <li class="breadcrumb-item" style="color: red;">
                            Perhitungan SAW
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ route('rank.detailr', $criteriaAnalysis->id) }}">
                                Perhitungan SAW
                            </a>
                        </li>
                    @endif
                </ol>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Lakukan perhitungan perbandingan
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    @if ($crValue > 0.1)
                        <a class="btn btn-success disabled">
                            <i class="fa-solid fa-ranking-star"></i>
                            Rangking Siswa
                        </a>
                    @else
                        <a href="{{ route('rank.final', $criteriaAnalysis->id) }}" class="btn btn-success">
                            <i class="fa-solid fa-ranking-star"></i>
                            Rangking Siswa
                        </a>
                    @endif
                    {{-- Display CR Value --}}
                    @if ($crValue > 0.1)
                        <td class="text-center text-danger" colspan="2">
                            <a href="{{ route('perbandingan.update', $criteriaAnalysis->id) }}" class="btn btn-danger mt-2">
                                Nilai Rasio Konsistensi <b>{{ $crValue }}</b> ≥ <b>0.1</b>
                                <br>
                            </a>
                        </td>
                    @elseif ($crValue === null)
                        <p></p>
                    @else
                        <p>Nilai Rasio Konsistensi: <b> {{ $crValue }}</b></p>
                    @endif
                </div>
                <table class="table table-bordered table-condensed table-responsive">
                    <tbody>
                        <tr>
                            <td scope="col" class="fw-bold" style="width:11%">Kategori</td>
                            @foreach ($dividers as $divider)
                                <td scope="col">{{ $divider['kategori'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td scope="col" class="fw-bold" style="width:11%">Nilai pembagi</td>
                            @foreach ($dividers as $divider)
                                <td scope="col">{{ $divider['divider_value'] }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table id="datatablesSimple" class="table table-bordered table-responsive">
                    <thead class="table-primary align-middle text-center">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Nama alternatif</th>
                            <th scope="col" class="text-center">Kelas</th>
                            @foreach ($dividers as $divider)
                                <th scope="col">{{ $divider['name'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @if (!empty($normalizations))
                            @foreach ($normalizations as $normalisasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ Str::ucfirst(Str::Upper($normalisasi['student_name'])) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $normalisasi['kelas_name'] }}
                                    </td>
                                    @foreach ($dividers as $key => $value)
                                        @if (isset($normalisasi['results'][$key]))
                                            <td class="text-center">
                                                {{ round($normalisasi['results'][$key], 2) }}
                                            </td>
                                        @else
                                            <td class="text-center">
                                                Empty
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
