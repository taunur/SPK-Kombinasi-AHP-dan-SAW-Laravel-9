@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('rank.show', $criteria_analysis->id) }}">Normalisasi
                            Tabel</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('rank.detailr', $criteria_analysis->id) }}">Perhitungan
                            SAW</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <a class="btn btn-warning" href="{{ route('rank.export', $criteria_analysis->id) }}">
                        <i class="fa-solid fa-download"></i>
                        Rangking
                    </a>
                </div>
                <table id="datatablesSimple" class="table table-bordered table-responsive">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nama alternatif</th>
                            <th scope="col">Kelas</th>
                            <th scope="col" class="text-center">Hasil perhitungan</th>
                            <th scope="col" class="text-center">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($ranks))
                            @php($rankResult = [])
                            @foreach ($ranks as $rank)
                                <tr>
                                    <td>
                                        {{ $rank['student_name'] }}
                                    </td>
                                    <td>
                                        {{ $rank['kelas_name'] }}
                                    </td>
                                    <td class="text-center">
                                        {{ round($rank['rank_result'], 4) }}
                                    </td>
                                    <td class="text-center fw-bold">
                                        {{ $loop->iteration }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
