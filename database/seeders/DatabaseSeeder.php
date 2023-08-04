<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::create([
            'name'     => 'Operator',
            'username' => 'adminer',
            'email'    => 'admin@spk.com',
            'password' => bcrypt('admin123'),
            'level'    => 'ADMIN'
        ]);

        Kelas::create([
            'kelas_name' => 'IX-A',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-B',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-C',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-D',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-E',
            'slug' => 'ix-e'
        ]);
        Kelas::create([
            'kelas_name' => 'IX-F',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-G',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-H',
        ]);
        Kelas::create([
            'kelas_name' => 'IX-I',
        ]);

        // Student::factory(300)->create();

        // Mata Pelajaran
        Criteria::create([
            'name' => 'Pendidikan Agama dan Budi Pekerti',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Bahasa Indonesia',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Matematika',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Ilmu Pengetahuan Alam',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Ilmu Pengetahuan Sosial',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
        Criteria::create([
            'name' => 'Bahasa Inggris',
            'kategori' => 'BENEFIT',
            'Keterangan' => "Semakin tinggi nilai, semakin besar peluang"
        ]);
    }
}
