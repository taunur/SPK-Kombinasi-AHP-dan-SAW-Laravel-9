<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    WithChunkReading
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $kelasName = $row['kelas_name'];
        $kelas     = Kelas::where('kelas_name', $kelasName)->first();

        return new Student([
            'nis'       => $row['nis'],
            'name'      => $row['name'],
            'gender'    => $row['gender'],
            'kelas_id'  => $kelas ? $kelas->id : null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*nis' => ['unique:students,nis, required'],
            'name' => ['required'],
            'gender' => ['required'],
            'kelas_name' => ['required'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
