<?php

// ClassroomsImport.php
namespace App\Imports;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari atau buat wali kelas
        // $teacher = Teacher::firstOrCreate(['name' => $row['teacher_name']]);

        // Buat atau update kelas dengan teacher_id
        if($row['type'] == 'BK') {
        $user = User::firstOrCreate(
            [
                'name' => $row['name'],
                'username' => $row['nip'],
                'role' => 'user',
                'email' => Str::slug($row['name']) . '@gmail.com',
                'password' => bcrypt('passbk' . $row['nip']),
            ]
            );
        }
        return new Teacher([
            'nip' => $row['nip'],
            'name' => $row['name'],
            'type' => $row['type']
            // 'wali_kelas' => $row['wali_kelas'],
        ]);
    }
}
