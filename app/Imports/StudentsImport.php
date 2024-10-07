<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $classroom = Classes::firstOrCreate(['name' => $row['class']]);
        Log::info('Data row:', $row);

        $classroom = Classroom::where('name', $row['classroom_id'])->first();

        if (!$classroom) {
            Log::warning('Classroom not found: ' . $row['classroom_id']);
            return null;
        }

        $student = Student::updateOrCreate(
             // Kondisi untuk menentukan apakah akan melakukan update atau create
            [
                'nipd' => $row['nipd'],
                'nisn' => $row['nisn'],
                'name' => $row['name'],
                'gender' => $row['gender'],
                'school_year_id' => $row['tahun_ajaran_id'],
                'phone_number' => $row['phone_number'],
                'classroom_id' => $classroom->id, // Pastikan ini menggunakan ID yang benar dari Classroom
                'name_parent' => $row['name_parent'],
                'phone_number_parent' => $row['phone_number_parent'],
                'phone_number_parent_opt' => $row['phone_number_parent_opt'],
            ]
        );


        Log::info('Student created/updated: ', $student->toArray());

        return $student;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
