<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\IndividualService;
use App\Models\Teacher;
use App\Tables\Individuals;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use ProtoneMedia\Splade\Facades\Toast;

class IndividualServiceController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Layanan Individual');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.individual.index', [
            'individuals' => Individuals::class,
        ]);
    }

    public function store(Request $request)
    {
        $classroom_id = Classroom::query()->where('name', $request->name)->firstOrFail();
        // dd($classroom_id->id);
        $teacher_id = $request->teacher_id;
        $teacher = Teacher::query()->findOrFail($teacher_id);

        IndividualService::query()->updateOrCreate(
            ['classroom_id' => $classroom_id->id], // or any other fields to indicate an update
            ['classroom_id' => $classroom_id->id, 'teacher_id' => $teacher_id],
        );

        Toast::success("Data Individual Sudah terkait dengan Guru $teacher->name, sudah Berhasil dibuat")->autoDismiss(5);
        return redirect()->route('individual.service.index');
    }

    public function edit(Classroom $classroom)
    {
        $this->spladeTitle('Edit Kelas');
        $teacher = Teacher::all();
        // $classroom = Classroom::all();
        return view('pages.individual.edit', [
            'classroom' => $classroom,
            'teacher' => $teacher,
        ]);
    }
}
