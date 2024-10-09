<?php

namespace App\Tables;

use App\Models\SchoolYear;
use App\Models\Student;
// use App\Models\StudentGraduate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class StudentGraduate extends AbstractTable
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
        return Student::query()->where('status', '!=', 'active');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {

        $schoolYears = SchoolYear::query()->get()->pluck('year', 'year')->toArray();
        $table
            ->column('nisn', sortable: true, searchable: true)
            ->column('nipd', sortable: true, searchable: true)
            ->column('name', sortable: true, searchable: true)
            ->selectFilter('schoolYear.year', $schoolYears, 'Filter Tahun Ajaran')
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
            ], 'Filter Kelas')
           
            ->column('phone_number', label: 'Nomor Telepon')
            ->column('classroom.name', label: 'Kelas')
            ->column('schoolYear.year', label: 'Tahun Ajaran')
            ->column('Actions')
            ->rowModal(fn(Student $user) => route('student.detail', ['id' => $user->id]))
            ->export(
                'Export Excel DATA siswa',
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
