<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Users extends AbstractTable
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
        return User::query();
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
            ->column('name', sortable: true, searchable: true)
            ->column('email', sortable: true, searchable: true)
            ->column('username', sortable: true, searchable: true)
            ->column('created_at', sortable: true)
            ->column('Actions')
            ->bulkAction(
                label: 'Delete User',
                each: fn (User $user) => $user->delete(),
                confirm: 'Delete User',
                confirmText: 'Are you sure you want to delete the users?',
                confirmButton: 'Yes, Delete all!',
                cancelButton: 'No, do not Delete!',
            )
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
