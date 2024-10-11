<?php

namespace App\Tables;

use App\Models\InformationService;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class InformationServices extends AbstractTable
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
        return InformationService::query()->with(['student', 'teacher']);
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
        ->column('teacher.name', label: 'Nama Guru BK')
        ->column('student.name', label: 'Nama Siswa')
        ->column('student.classroom.name', label: 'Kelas')
        ->column('date', label: 'Tanggal')
        ->column('note', label: 'Keterangan');
            //->withGlobalSearch(columns: ['id'])

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
