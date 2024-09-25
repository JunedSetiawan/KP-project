<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Classroom;
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
        // $classroom = Classes::firstOrCreate(['name' => $row['class']]);

        // Buat student
        return new Classroom([
            'name' => $row['name'],
            
        ]);
    }
}