@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($ranking) }} --}}
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('rank.show', $criteriaAnalysis->id) }}">Normalisasi
                            Tabel</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rank.final', $criteriaAnalysis->id) }}">Student Rank</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">

                <div class="d-sm-flex align-items-center">
                    <div class="mb-4">
                        <h4 class="mb-0 text-gray-800">Normalisasi Alternatif Siswa</h4>
                    </div>
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
                        <tr>
                            <td scope="col" class="fw-bold" style="width:11%">Nilai prioritas</td>
                            @foreach ($criteriaAnalysis->priorityValues as $key => $innerpriorityvalue)
                                <td>
                                    {{ round($innerpriorityvalue->value, 3) }}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <table id="datatablesSimple2" class="table table-bordered">
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
                                        {{ $normalisasi['student_name'] }}
                                    </td>
                                    <td class="text-center">
                                        {{ $normalisasi['kelas_name'] }}
                                    </td>

                                    @foreach ($dividers as $key => $divider)
                                        @php
                                            $val = isset($normalisasi['alternative_val'][$key]) ? $normalisasi['alternative_val'][$key] : null;
                                            $result = isset($normalisasi['results'][$key]) ? round($normalisasi['results'][$key], 2) : null;
                                        @endphp
                                        <td class="text-center">
                                            @if ($result !== null)
                                                @if ($divider['kategori'] === 'BENEFIT' && $val != 0)
                                                    {{ $val }} / {{ $divider['divider_value'] }} =
                                                @elseif ($divider['kategori'] === 'COST' && $val != 0)
                                                    {{ $divider['divider_value'] }} / {{ $val }} =
                                                @endif
                                                {{ $result }}
                                            @else
                                                Empty
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-responsive">
                    <div class="mb-4">
                        <h4 class="mb-0 text-gray-800">Rangking Siswa</h4>
                    </div>
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Nama alternatif</th>
                            <th scope="col">Kelas</th>
                            @foreach ($dividers as $divider)
                                <th scope="col">
                                    Hitung {{ $divider['name'] }}
                                </th>
                            @endforeach
                            <th scope="col" class="text-center">Hasil perhitungan</th>
                            <th scope="col" class="text-center">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($ranking))
                            @php($rankResult = [])
                            @php($hasilKali = [])
                            @foreach ($ranking as $rank)
                                <tr>
                                    <td>
                                        {{ $rank['student_name'] }}
                                    </td>
                                    <td>
                                        {{ $rank['kelas_name'] }}
                                    </td>
                                    @foreach ($criteriaAnalysis->priorityValues as $key => $innerpriorityvalue)
                                        @php($hasilNormalisasi = isset($rank['results'][$key]) ? $rank['results'][$key] : 0)
                                        <td class="text-center">
                                            @php($kali = $innerpriorityvalue->value * $hasilNormalisasi)
                                            @php($res = substr($kali, 0, 11))
                                            @php(array_push($hasilKali, $res))
                                            ({{ round($innerpriorityvalue->value, 3) }} *
                                            {{ round($hasilNormalisasi, 3) }})
                                            =
                                            {{ round($res, 3) }}
                                        </td>
                                    @endforeach

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
