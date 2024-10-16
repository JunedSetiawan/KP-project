<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'username' => 'admin zapo',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Guru BK',
            'email' => 'user@example.com',
            'username' => 'bk zapo',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        \App\Models\User::create([
            'name' => 'Siswa',
            'email' => 'siswa@example.com',
            'username' => 'siswa zapo',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $this->call([SchoolYearSeeder::class, ClassesSeeder::class, SemesterSeeder::class]);
    }
}
