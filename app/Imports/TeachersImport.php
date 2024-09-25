<?php

// ClassroomsImport.php
namespace App\Imports;

use App\Models\Classroom;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari atau buat wali kelas
        // $teacher = Teacher::firstOrCreate(['name' => $row['teacher_name']]);

        // Buat atau update kelas dengan teacher_id
        return new Teacher([
            'nip' => $row['nip'],
            'name' => $row['name'],
            'wali_kelas' => $row['wali_kelas'],
        ]);
    }
}
