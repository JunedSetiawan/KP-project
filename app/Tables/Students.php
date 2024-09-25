<?php

namespace App\Tables;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
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
        return Student::query()->with('classes');
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
            ->selectFilter('gender', [
                'L' => 'Laki Laki',
                'P' => 'Perempuan',
            ])
            ->column('phone_number')
            ->column('classes.name')
            ->column('Actions')
            ->withGlobalSearch(columns: ['nis'])
            ->export(
                'export',
                'project.xlsx',
                Excel::XLSX
            )
            ->paginate(5);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
