<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RanksExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $ranking;
    private $normalisasiAngka;

    public function __construct(array $ranking, array $normalisasiAngka)
    {
        $this->ranking = $ranking;
        $this->normalisasiAngka = $normalisasiAngka;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->ranking as $key => $rank) {
            $rowData = [
                'rank' => $key + 1,
                'student_name' => $rank['student_name'],
                'kelas_name' => $rank['kelas_name'],
            ];


            foreach ($rank['criteria_name'] as $index => $criteriaName) {
                $rowData[$criteriaName] = round($this->normalisasiAngka[$key]['results'][$index], 3);
            }

            $rowData['rank_result'] = round($rank['rank_result'], 3);

            $data[] = $rowData;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $firstRank = $this->ranking[0];

        $headingRow = [
            'Rank',
            'Nama Siswa',
            'Nama Kelas',
        ];

        foreach ($firstRank['criteria_name'] as $criteriaName) {
            $headingRow[] = $criteriaName;
        }

        $headingRow[] = 'Perhitungan SAW';

        return $headingRow;
    }
}
