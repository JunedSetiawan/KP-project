<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $classroom = Classes::firstOrCreate(['name' => $row['class']]);

        // Buat student
        return new Student([
            'nis' => $row['nis'],
            'name' => $row['name'],
            'gender' => $row['gender'],
            'phone_number' => $row['phone_number'],
            'classes_id' => $row['classes_id'],
            'name_parent' => $row['name_parent'],
            'phone_number_parent' => $row['phone_number_parent'],
            'phone_number_parent_opt' => $row['phone_number_parent_opt'],
            
        ]);
    }
}
