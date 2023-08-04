<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    WithBatchInserts
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'      => $row['name'],
            'email'     => $row['email'],
            'username'  => $row['username'],
            'password'  => Hash::make($row['password']),
            'level'     => $row['level'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            '*email' => ['email', 'unique:users,email'],
            '*username' => ['unique:users,username'],
            'password' => ['required'],
            'level' => ['required']
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
