<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class = [
            [
                'name' => '7A',
            ],
            [
                'name' => '8B',
            ],
            [
                'name' => '9C',
            ],
        ];

        foreach ($class as $key => $value) {
            \App\Models\Classroom::create($value);
        }
        
    }
}
