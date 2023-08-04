<?php

namespace App\Imports;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;

class AlternativesImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    WithChunkReading
{
    public function model(array $row)
    {
        // @dd($row);
        // Kelas
        $kelasName = $row['kelas_name'];
        $kelas     = Kelas::where('kelas_name', $kelasName)->first();
        // Student
        $studentName = $row['nama_siswa'];
        $student     = Student::where('name', $studentName)->first();

        $criteriaColumns = [];
        $alternativeValues = [];

        foreach ($row as $columnName => $columnValue) {
            if ($columnName !== 'nama_siswa' && $columnName !== 'kelas_name') {
                $criteriaColumns[] = $columnName;
                $alternativeValues[] = $columnValue;
            }
        }

        // Hapus semua alternatif terkait siswa dan kelas saat ini
        Alternative::where('student_id', $student->id)
            ->where('kelas_id', $kelas->id)
            ->delete();

        // Iterasi pada array kolom criteria dan alternative_value
        for ($i = 0; $i < count($criteriaColumns); $i++) {
            $columnName = $criteriaColumns[$i];
            $columnValue = $alternativeValues[$i];

            // Convert columnName to slug format
            $criteriaName = Str::slug($columnName, '-');

            // Find the criteria based on the criteria slug
            $criteria = Criteria::where('slug', $criteriaName)->first();

            if ($criteria) {
                // Create the new alternative based on student, kelas, criteria, and alternative_value
                $alternative = new Alternative();
                $alternative->student_id = $student ? $student->id : null;
                $alternative->kelas_id = $kelas ? $kelas->id : null;
                $alternative->criteria_id = $criteria->id;
                $alternative->alternative_value = $columnValue;
                $alternative->save();
            }
        }

        return null;
    }


    public function rules(): array
    {
        return [
            'nama_siswa'    => ['required'],
            'kelas_name'    => ['required'],
        ];
    }


    public function chunkSize(): int
    {
        return 1000;
    }
}
