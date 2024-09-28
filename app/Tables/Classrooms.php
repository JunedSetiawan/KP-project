<?php

namespace App\Tables;

use App\Models\Classroom;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Classrooms extends AbstractTable
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
        return Classroom::query(); // Gunakan query builder untuk pagination
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
            ->column('name', sortable: true, searchable: true, label: 'Kelas')
            ->column('teacher.name', searchable: true, label: 'Wali Kelas')
            ->column('actions')
            ->paginate(10); // Pagination Splade, tanpa memanggil get()
    }
}
