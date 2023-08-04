<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory, Sluggable;

    // protected $guarded = ['id'];

    protected $fillable = [
        'kelas_name',
        'slug'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kelas_name'
            ]
        ];
    }
}
