<?php

namespace App\Tables;

use App\Models\LogAttendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class ListLogAttendances extends AbstractTable
{
    protected $classroom_id;
    protected $date;

    /**
     * Create a new instance with classroom and date.
     *
     * @param int $classroom_id
     * @param string $date
     */
    public function __construct($classroom_id, $date)
    {
        $this->classroom_id = $classroom_id;
        $this->date = $date;
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     * This method must match the signature in the base AbstractTable class.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function for()
    {
        // Fetch attendance records for the specified classroom and date
        return LogAttendance::where('classrooms_id', $this->classroom_id)
            ->whereDate('date', $this->date);
    }

    /**
     * Configure the Splade table.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->column('student.name', sortable: true, searchable: true)
            ->column('information', sortable: true, searchable: true)
            ->column('note', sortable: true, searchable: true)
            ->export(
                label: 'Export',
                filename: 'daftar_hadir.xlsx',
                type: Excel::XLSX
            )
            ->paginate(10);

        // Additional table configurations can go here
    }
}
