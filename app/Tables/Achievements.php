<?php

namespace App\Tables;

use App\Models\Achievement;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Achievements extends AbstractTable
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
        return Achievement::query()->with('student')->get();
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
        ->column('student.name', label: 'Nama Siswa', sortable: true)
            ->column('achievement', label: 'Prestasi', sortable: true)
            ->column('note', label: 'Keterangan', sortable: true)
            ->column('point', label: 'Poin', sortable: true)
            ->column('actions');
            // ->withGlobalSearch(columns: ['id'])
            // ->column('id', sortable: true);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
