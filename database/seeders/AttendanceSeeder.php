<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::create([
            'student_id' => 1,
            'classrooms_id' => 13,
            'date' => now(),
            'information' => 'Sakit',
            'note' => 'Sakit'
        ]);
        Attendance::create([
            'student_id' => 2,
            'classrooms_id' => 14,
            'date' => now(),
            'information' => 'Ijin',
            'note' => 'Ijin'
        ]);
    }
}
