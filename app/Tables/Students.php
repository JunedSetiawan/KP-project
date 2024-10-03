<?php

namespace App\Tables;

use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentClassHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;
use PhpParser\Node\Stmt\Label;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Students extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {   
        return Student::query()->with(['classroom','schoolYear']);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {    $schoolYears = SchoolYear::query()->get()->pluck('year', 'year')->toArray();

            $table
            ->column('nisn', sortable: true)
            ->column('nipd', sortable: true, searchable: true)
            ->column('name', sortable: true, searchable: true)
            ->selectFilter('schoolYear.year', $schoolYears)
            ->selectFilter('classroom.name', [
                '7A' => '7A',
                '7B' => '7B',
                '7C' => '7C',
                '7D' => '7D',
                '7E' => '7E',
                '7F' => '7F',
                '7G' => '7G',
                '7H' => '7H',
                '7I' => '7I',
                '8A' => '8A',
                '8B' => '8B',
                '8C' => '8C',
                '8D' => '8D',
                '8E' => '8E',
                '8F' => '8F',
                '8G' => '8G',
                '8H' => '8H',
                '8I' => '8I',
                '9A' => '9A',
                '9B' => '9B',
                '9C' => '9C',
                '9D' => '9D',
                '9E' => '9E',
                '9F' => '9F',
                '9G' => '9G',
                '9H' => '9H',
                '9I' => '9I',
            ])
            ->selectFilter('classroom.name', [
                '7A' => '7A',
                '7B' => '7B',
                '7C' => '7C',
                '7D' => '7D',
                '7E' => '7E',
                '7F' => '7F',
                '7G' => '7G',
                '7H' => '7H',
                '7I' => '7I',
                '8A' => '8A',
                '8B' => '8B',
                '8C' => '8C',
                '8D' => '8D',
                '8E' => '8E',
                '8F' => '8F',
                '8G' => '8G',
                '8H' => '8H',
                '8I' => '8I',
                '9A' => '9A',
                '9B' => '9B',
                '9C' => '9C',
                '9D' => '9D',
                '9E' => '9E',
                '9F' => '9F',
                '9G' => '9G',
                '9H' => '9H',
                '9I' => '9I',
            ])
            ->column('phone_number', label: 'Nomor Telepon')
            ->column('classroom.name', label: 'Kelas')
            ->column('schoolYear.year', label: 'Tahun Ajaran')
            ->rowModal(fn (Student $user) => route('student.detail', ['id' => $user->id]))
            ->column('Actions')
            ->bulkAction(
                label: 'Kenaikan Kelas',
                each: fn (Student $user) => $user->touch(),
                confirm: 'Siswa Kenaikan Kelas',
                confirmText: 'Apakah yakin ingin menaikkan kelas siswa ini?',
                confirmButton: 'Iya',
                cancelButton: 'Tidak',
                before: function (array $selectedIds) {
                    $students = Student::query()->with('classroom', 'schoolyear')
    ->unless($selectedIds === ['*'], fn($query) => $query->whereIn('id', $selectedIds))
    ->get();

foreach ($students as $student) {
    // Simpan riwayat kelas lama siswa di tabel StudentClassHistory
    StudentClassHistory::create([
        'student_id'      => $student->id,
        'classroom_id'    => $student->classroom->id,  // Kelas lama
        'school_year_id'  => $student->schoolyear->id, // Tahun ajaran lama
    ]);

    // Ambil nama kelas, misalnya "8A"
    $classroomName = $student->classroom->name;

    // Ekstrak angka dari nama kelas (contoh: 8)
    $classNumber = intval(preg_replace('/[^0-9]/', '', $classroomName));

    // Jika kelas 9, tidak diperbolehkan naik kelas
    if ($classNumber == 9) {
        Toast::warning('Siswa kelas 9 tidak diperbolehkan naik kelas')->autoDismiss(5);
        return redirect()->back();
    }

    // Ambil huruf kelas (contoh: "A", "B", dll)
    $classType = preg_replace('/[0-9]/', '', $classroomName); // Menghapus angka, menyisakan huruf

    // Tambah angka kelas dengan 1 (misalnya dari "8A" ke "9A")
    $nextClassNumber = $classNumber + 1;

    // Buat nama kelas baru dengan angka yang ditingkatkan dan huruf yang sama (misalnya "9A")
    $nextClassName = $nextClassNumber . $classType;

    // Cari kelas baru berdasarkan nama kelas baru (misalnya "9A")
    $newClassroom = Classroom::where('name', $nextClassName)->first();

    if ($newClassroom) {
        // Cek tahun ajaran sekarang (misal: "2024/2025")
        $currentYear = $student->schoolyear->year; // "2024/2025"
        
        // Pisahkan tahun ajaran untuk mendapatkan awal dan akhir tahun
        list($startYear, $endYear) = explode('/', $currentYear);

        // Tambah satu tahun ke awal dan akhir tahun untuk tahun ajaran baru
        $newStartYear = (int)$startYear + 1;
        $newEndYear = (int)$endYear + 1;
        $newSchoolYear = $newStartYear . '/' . $newEndYear; // Misalnya, "2025/2026"

        // Cek apakah tahun ajaran baru sudah ada di database
        $schoolYear = SchoolYear::where('year', $newSchoolYear)->first();

        // Jika tidak ada, buat tahun ajaran baru
        if (!$schoolYear) {
            $schoolYear = SchoolYear::create([
                'year' => $newSchoolYear, // Simpan sebagai "2025/2026"
            ]);
        }

        // Update classroom_id dan tahun ajaran siswa dengan tahun ajaran baru
        $student->classroom_id = $newClassroom->id;
        $student->school_year_id = $schoolYear->id; // Set tahun ajaran baru yang sudah dibuat/ditemukan
        $student->save(); // Simpan perubahan

        Toast::success('Kenaikan Kelas pada siswa berhasil, Silahkan cek menggunakan filter tahun ajaran terbaru :)')->autoDismiss(5);
    } else {
        Log::info("Kelas dengan nama " . $nextClassName . " tidak ditemukan.\n");
    }
}

                

             
                },
            )
            ->export(
                'Export',
                'daftar_siswa.xlsx',
                Excel::XLSX
            )
            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
