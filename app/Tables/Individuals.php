<?php

namespace App\Tables;

use App\Models\Classroom;
use App\Models\Individual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Individuals extends AbstractTable
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
        $user = Auth::user();

        // Memastikan user memiliki classroom_id
        if ($user && $user->student && $user->student->classroom_id) {
            $classroomId = $user->student->classroom_id;

            // Mengambil data Classroom yang sesuai dengan classroom_id siswa yang login
            return Classroom::query()
                ->with('individualServices')
                ->where('id', $classroomId)
                ->get();
        }

        return Classroom::query()->with('individualServices')->get();
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
        ->column('name', sortable:true, searchable: true, label: 'Kelas')
        ->column('individualServices.teacher.name', label: 'Guru Penanggung Jawab')
        ->column('actions')
        ->rowLink(fn (Classroom $classroom) => route('logattendance.listdate', ['id' => $classroom->id]));

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
