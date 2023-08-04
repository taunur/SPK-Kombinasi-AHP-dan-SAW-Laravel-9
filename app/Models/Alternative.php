<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $fillable = ['student_id', 'criteria_id', 'kelas_id', 'alternative_value'];

    public function getKeyName()
    {
        return 'student_id';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function studentList()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Nilai Pembagi
    public static function getDividerByCriteria($criterias)
    {
        $dividers = [];

        foreach ($criterias as $criteria) {
            if ($criteria->kategori === 'BENEFIT') {
                $divider = static::where('criteria_id', $criteria->id)
                    ->max('alternative_value');
            } else if ($criteria->kategori === 'COST') {
                $divider = static::where('criteria_id', $criteria->id)
                    ->min('alternative_value');
            }

            $data = [
                'criteria_id'   => $criteria->id,
                'name'          => $criteria->name,
                'kategori'      => $criteria->kategori,
                'divider_value' => floatval($divider)
            ];

            array_push($dividers, $data);
        }

        return $dividers;
    }


    // get alternative
    public static function getAlternativesByCriteria($criterias)
    {
        $results = static::with('criteria', 'studentList', 'kelas')
            ->whereIn('criteria_id', $criterias)
            ->get();

        if (!$results->count()) {
            return $results;
        }

        $finalRes = [];

        foreach ($results as $result) {
            $isExists = array_search($result->student_id, array_column($finalRes, 'student_id'));

            if ($isExists !== '' && $isExists !== null && $isExists !== false) {
                array_push($finalRes[$isExists]['criteria_id'], $result->criteria->id);
                array_push($finalRes[$isExists]['criteria_name'], $result->criteria->name);
                array_push($finalRes[$isExists]['alternative_val'], $result->alternative_value);
            } else {
                $data = [
                    'student_id'        => $result->student_id,
                    'student_name'      => $result->studentList->name,
                    'kelas_id'          => $result->kelas->id,
                    'kelas_name'        => $result->kelas->kelas_name,
                    'criteria_id'       => [$result->criteria->id],
                    'criteria_name'     => [$result->criteria->name],
                    'alternative_val'   => [$result->alternative_value]
                ];

                array_push($finalRes, $data);
            }
        }

        return $finalRes;
    }

    public static function checkAlternativeByCriterias($criterias)
    {
        $isAllCriteriaPresent = false;

        foreach ($criterias as $criteria) {
            $check = static::where('criteria_id', $criteria)->get()->count();

            if ($check > 0) {
                $isAllCriteriaPresent = true;
            } else {
                $isAllCriteriaPresent = false;
                break;
            }
        }

        return $isAllCriteriaPresent;
    }
}
