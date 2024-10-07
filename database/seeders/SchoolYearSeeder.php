<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolYear::create([
            'year' => '2024/2025',
            'status' => 1,
        ]);
        SchoolYear::create([
            'year' => '2025/2026',
            'status' => 1,
        ]);
    }
}
