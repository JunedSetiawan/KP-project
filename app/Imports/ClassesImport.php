<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
{
    // Logging data sebelum disimpan
    Log::info('Data row:', $row);
    
    // Mengambil teacher berdasarkan nama di teacher_id, bukan name
    $teacher = Teacher::where('name', $row['teacher_id'])->first(); // Menggunakan first() untuk mendapatkan satu model, bukan collection

    // Jika teacher tidak ditemukan, log dan skip
    if (!$teacher) {
        Log::warning('Teacher not found: ' . $row['teacher_id']);
        return null;
    }

    // Update atau buat classroom berdasarkan nama kelas (name) dan teacher_id
    $classroom = Classroom::updateOrCreate(
        ['name' => $row['name']],
        ['teacher_id' => $teacher->id]
    );

    // Logging classroom yang dibuat atau diperbarui
    Log::info('Classroom created/updated: ', $classroom->toArray());
    
    return $classroom;
}



}