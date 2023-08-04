@extends('layouts.admin')

@section('content')

    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">{{ $title }}</h1>
        <p>Masukan Nilai rata-rata dari Semester 1-5</p>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST"
        action="{{ route('alternatif.update', $alternatives->id) }}">
        @method('PUT')
        @csrf

        <fieldset disabled>
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <label for="name" class="form-label">Nama yang dipilih</label>
                    <input type="text" class="form-control" id="disabledTextInput" id="name"
                        value="{{ old('name', $alternatives->name) }}" readonly required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="name" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="disabledTextInput" id="name"
                        value="{{ old('name', $alternatives->kelas->kelas_name) }}" readonly required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </fieldset>

        @foreach ($alternatives->alternatives as $value)
            <div class="mb-3">
                <input type="hidden" name="criteria_id[]" value="{{ $value->criteria->id }}">
                <input type="hidden" name="alternative_id[]" value="{{ $value->id }}">

                <label for="{{ str_replace(' ', '', $value->criteria->name) }}" class="form-label">
                    Nilai <b> {{ $value->criteria->name }} </b>
                </label>
                <input type="text" id="{{ str_replace(' ', '', $value->criteria->name) }}"
                    class="form-control @error('alternative_value') 'is-invalid' : '' @enderror" name="alternative_value[]"
                    placeholder="Enter the value"
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)|| event.charCode == 46)"
                    value="{{ floatval($value->alternative_value) }}" maxlength="5" autocomplete="off" required>

                @error('alternative_value')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endforeach

        @if ($newCriterias->count())
            <input type="hidden" name="new_student_id" value="{{ $alternatives->id }}">
            <input type="hidden" name="new_kelas_id" value="{{ $alternatives->kelas_id }}">
            @foreach ($newCriterias as $value)
                <div class="mb-3">
                    <input type="hidden" name="new_criteria_id[]" value="{{ $value->id }}">
                    <label for="{{ str_replace(' ', '', $value->name) }}" class="form-label">
                        Nilai <b> {{ $value->name }} </b>
                    </label>
                    <input type="text" id="{{ str_replace(' ', '', $value->name) }}"
                        class="form-control @error('new_alternative_value') 'is-invalid' : '' @enderror"
                        name="new_alternative_value[]" placeholder="Enter the value"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)|| event.charCode == 46)"
                        maxlength="3" autocomplete="off" required>

                    @error('new_alternative_value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endforeach
        @endif

        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="/dashboard/alternatif" class="btn btn-danger mb-3">Cancel</a>
    </form>


@endsection
