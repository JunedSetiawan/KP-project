<?php

namespace App\Tables;

use App\Models\StudentClassHistory;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class StudentClassHistorys extends AbstractTable
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
        return StudentClassHistory::query()->with('student','classroom','schoolYear');
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
            ->withGlobalSearch(columns: ['id', 'student_id', 'classroom_id', 'school_year_id'])
            ->column('id', label: 'ID', sortable: true)
            ->column('student.name', label: 'Nama Siswa', sortable: true)
            ->column('classroom.name', label: 'Kelas', sortable: true)
            ->column('schoolYear,year', label: 'Tahun Ajaran', sortable: true);

        // Menambahkan input pencarian, filter, aksi masal, dan export jika dibutuhkan
        // ->searchInput('student_id', label: 'Search by Student ID')
        // ->selectFilter('classroom_id', label: 'Filter by Classroom')
        // ->bulkAction('Delete', function ($selectedIds) {
        //     StudentClassHistory::whereIn('id', $selectedIds)->delete();
        // })
        // ->export();
    }
}
