<?php
function filterDetailResults($detail)
{
    $resultFix = [];

    for ($i = 0; $i < count($detail); $i++) {
        // lewati jika kriteria sama
        if ($detail[$i]->criteria_id_first === $detail[$i]->criteria_id_second) {
            continue;
        }

        // id kriteria pertama pada id kriteria kedua
        $isAnyFirstCriteria = searchArray($resultFix, 'criteria_id_second', $detail[$i]->criteria_id_first);

        // id kriteria kedua pada id kriteria pertama
        $isAnySecondCriteria = searchArray($resultFix, 'criteria_id_first', $detail[$i]->criteria_id_second);

        // check apakah ada perbandingan kriteria sebelumnya
        $prevComparison = false;

        if ($isAnyFirstCriteria && $isAnySecondCriteria) {
            $prevComparison = true;
        }

        // masukkan ke resultFix jika tidak ada perbandingan sebelumnya
        if ($prevComparison === false) {
            array_push($resultFix, $detail[$i]);
        }
    }

    return $resultFix;
}

function searchArray($arrayName, $keyName, $valueName)
{
    return in_array($valueName, array_column($arrayName, $keyName));
}
