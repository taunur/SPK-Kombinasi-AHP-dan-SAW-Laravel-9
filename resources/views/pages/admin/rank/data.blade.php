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
            <div class="card-body table-responsive">
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
                        @if ($criteria_analysis->count())
                            @foreach ($criteria_analysis as $analysis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $analysis->user->name }}</td>
                                    <td>
                                        @foreach ($analysis->details->unique('criteria_id_second') as $key => $detail)
                                            {{ $detail->criteria_name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $analysis->created_at->toDayDateTimeString() }}</td>
                                    @if ($isAbleToRank)
                                        <td>
                                            <a href="{{ route('rank.show', $analysis->id) }}"
                                                class="badge bg-success text-decoration-none">
                                                <i class="fa-solid fa-eye"></i>
                                                Perangkingan
                                            </a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <span role="button" class="badge bg-danger text-decoration-none">
                                                Tunggu Operator
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-danger text-center p-4">
                                    <h4>Operator belum membuat perbandingan kriteria</h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
