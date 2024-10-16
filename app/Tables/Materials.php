<?php

namespace App\Tables;

use App\Models\Material;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Materials extends AbstractTable
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
        return Material::query()->with('semester')->get();
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
        ->column('name', sortable: true, searchable: true, label: 'Nama Materi')
        ->column('formatted_semester', label: 'Semester')
        ->rowLink(fn (Material $material) => route('detailmaterial.index',['material_id' => $material->id]))
        ->column('actions');
           // ->withGlobalSearch(columns: ['id']);
            //->column('id', sortable: true);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
