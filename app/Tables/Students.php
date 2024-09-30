<?php

namespace App\Tables;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentClassHistory;
use App\Models\User;
use Illuminate\Http\Request;
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
        return Student::query()->with('classroom','schoolyear');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
            $table
            ->column('nis', sortable: true, searchable: true)
            ->column('name', sortable: true, searchable: true)
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
            ->column('schoolyear.year', label: 'Tahun Ajaran')
            ->column('Actions')
            ->bulkAction(
                label: 'Kenaikan Kelas',
                each: fn (Student $user) => $user->touch(),
                confirm: 'Touch projects',
                confirmText: 'Are you sure you want to touch the projects?',
                confirmButton: 'Yes, touch all selected rows!',
                cancelButton: 'No, do not touch!',
                before: function (array $selectedIds) {
                    $students = Student::query()->with('classroom','schoolyear')
                        ->unless($selectedIds === ['*'], fn ($query) => $query->whereIn('id', $selectedIds))
                        ->get();

foreach ($students as $student) {
    StudentClassHistory::create([
        'student_id' => $student->id,
        'classroom_id' => $student->classroom->id,
        'school_year_id' => $student->schoolYear->id ?? '',
    ]);

    $classroomName = $student->classroom->name;

    // Ekstrak angka dari nama kelas (contoh: 7)
    $classNumber = intval(preg_replace('/[^0-9]/', '', $classroomName));
    // jika kelas 9 maka redirect kmbali
    if ($classNumber == 9) {
        Toast::warning('Kelas 9 tidak diperbolehkan')->autoDismiss(5);
        return redirect()->back();
    }

    // Tambah angka dengan 1
    $nextClassNumber = $classNumber + 1;
    $newClassroom = Classroom::where('name', $nextClassNumber)->first();
    if ($newClassroom) {

        // Update classroom_id siswa dengan kelas terbaru
        $student->classroom_id = $newClassroom->id;
        $student->save(); // Simpan perubahan
    }

}

             
                },
                after: fn () => Toast::info('Timestamps updated!')
            )
            ->export(
                'export',
                'project.xlsx',
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
