<?php

namespace App\Tables;

use App\Models\Attendance;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Attendances extends AbstractTable
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
        return Attendance::query()->with('classrooms')->get();
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
        ->column('classrooms.name', sortable:true, searchable: true, label: 'Class')
        ->column('classrooms.teacher.name', sortable:true, searchable: true, label: 'Guru')
        ->rowLink(fn (Attendance $attendance) => route('attendance.list', ['id' => $attendance->id]))
        ->column('date', sortable:true)
        ->column('information', sortable:true)
        ->column('note')

            ->withGlobalSearch(columns: ['id']);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
