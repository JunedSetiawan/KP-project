<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas7 = Classroom::query()->findOrFail(2);

        $kelas8 = Classroom::query()->findOrFail(11);

        $kelas9 = Classroom::query()->findOrFail(20);

        Semester::create([
            'classroom_id' => $kelas7->id,
            'name' => 'Ganjil',
        ]);
        Semester::create([
            'classroom_id' => $kelas7->id,
            'name' => 'Genap',
        ]);

        Semester::create([
            'classroom_id' => $kelas8->id,
            'name' => 'Ganjil',
        ]);
        Semester::create([
            'classroom_id' => $kelas8->id,
            'name' => 'Genap',
        ]);

        Semester::create([
            'classroom_id' => $kelas9->id,
            'name' => 'Ganjil',
        ]);
        Semester::create([
            'classroom_id' => $kelas9->id,
            'name' => 'Genap',
        ]);
    }
}
