<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationService\InformationServiceRequest;
use App\Models\Classroom;
use App\Models\InformationService;
use App\Models\Student;
use App\Models\Teacher;
use App\Tables\InformationServices;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Components\Toast;
use ProtoneMedia\Splade\Facades\Toast as FacadesToast;

class InformationServiceController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Daftar Layanan Informasi');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.informationservice.index', [
            'informationservices' => InformationServices::class,
        ]);
    }

    public function public()
    {
        $this->spladeTitle('Layanan Informasi');
        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();
        $teachers = Teacher::where('type', 'BK')->pluck('name', 'id')->toArray();
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.public', [
            'teachers' => $teachers,
            'classrooms' => $classrooms
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Layanan Informasi');
        $classrooms = Classroom::pluck('name', 'id')->toArray();
        $teachers = Teacher::where('type', 'BK')->pluck('name', 'id')->toArray();
        return view('pages.public', [
            'teachers' => $teachers,
            'classrooms' => $classrooms
        ]);
    }

    public function store(InformationServiceRequest $request)
    {
        $validated = $request->validated();
        $informationservice = InformationService::create([
            'student_id' => $validated['student'], 
            'teacher_id' => $validated['teacher'],
            'date' => $validated['date'],
            'note' => $validated['keterangan'],
        ]);

        FacadesToast::success('Layanan Informasi Berhasil dibuat')->autoDismiss(5);

        return redirect()->route('informationservice.public');
    }


    public function loadStudent($classroom)
    {
        $data = Student::where('classroom_id', $classroom)->get();
        return response()->json($data);
    }
}
