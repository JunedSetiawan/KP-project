<?php
// TeachersImport.php
namespace App\Imports;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = null;

        // Create user only if type is 'BK'
        if ($row['type'] == 'BK') {
            $user = User::firstOrCreate(
                ['username' => $row['nip']],
                [
                    'name' => $row['name'],
                    'role' => 'user',
                    'email' => Str::slug($row['name']) . '@gmail.com',
                    'password' => bcrypt('passbk' . $row['nip']),
                ]
            );
        }

        // Create or update teacher
        $teacherData = [
            'nip' => $row['nip'],
            'name' => $row['name'],
            'type' => $row['type'],
        ];

        // Only add user_id if user was created
        if ($user) {
            $teacherData['user_id'] = $user->id;
        }

        $teacher = Teacher::updateOrCreate(
            ['nip' => $row['nip']],
            $teacherData
        );

        // Log the creation/update
        Log::info('Teacher created/updated: ', [$teacher->toArray()]);
        if ($user) {
            Log::info('User created/updated: ', [$user->toArray()]);
        }

        return $teacher;
    }
}