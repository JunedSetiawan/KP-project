<?php

namespace App\Tables;

use App\Models\LogAttendance;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class ListDateLogAttendances extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    protected $classroomId;

    // Constructor menerima classroomId
    public function __construct($classroomId)
    {
        $this->classroomId = $classroomId;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return LogAttendance::where('classrooms_id', $this->classroomId)
            ->select('date', 'classrooms_id')
            ->distinct('date')
            ->orderBy('date', 'asc');
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
            ->column('date', sortable: true, searchable: true)
            ->column('classroom.name', sortable: true, searchable: true)
            ->rowLink(fn ($log) => route('logattendance.list', ['classroom_id' => $this->classroomId, 'date' => $log->date]))
            ->paginate(10);
    }
}
