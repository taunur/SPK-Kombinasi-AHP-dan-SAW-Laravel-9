<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::select('nis', 'name', 'gender')
            ->leftJoin('kelas', 'students.kelas_id', '=', 'kelas.id')
            ->selectRaw('students.nis, students.name, students.gender, kelas.kelas_name')
            ->orderBy('kelas.kelas_name')
            ->orderBy('students.name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'nis',
            'name',
            'gender',
            'kelas_name',
        ];
    }
}
