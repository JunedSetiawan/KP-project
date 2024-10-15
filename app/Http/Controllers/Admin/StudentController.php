<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use App\Tables\StudentGraduate;
use App\Tables\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;

class StudentController extends Controller
{

    public function index()
    {
        $this->spladeTitle('Siswa');

        // dd($schoolYears);
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.student.index', [
            'students' => Students::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Siswa');

        // $roles = [
        //     'sales' => 'Sales',
        //     'purchase' => 'Purchase',
        //     'manager' => 'Manager',
        // ];

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();

        return view('pages.student.create', [
            'classrooms' => $classrooms
        ]);
    }

    public function store(StudentRequest $request)
    {
        try{
            DB::beginTransaction();
        
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $schoolYear = "{$currentYear}/{$nextYear}";

        $schoolYearRecord = SchoolYear::firstOrCreate(
            ['year' => $schoolYear],
            ['status' => true]
        );

         $user = User::create(
            [
                'name' => $validated['name'],
                'username' => $validated['nipd'],
                'role' => 'student',
                'email' => $validated['nipd'] . '@gmail.com',
                'password' => bcrypt('pass' . $validated['nipd']),
            ]);

        $student = Student::create(array_merge($validated, [
            'user_id' => $user->id,
            'school_year_id' => $schoolYearRecord->id,
        ]));

        DB::commit();
        Toast::success('Siswa Berhail Dibuat!')->autoDismiss(5);
    }catch (\Exception $e) {
        DB::rollBack();
    }

        return redirect()->route('student.index');
    }

    public function edit(Student $student)
    {
        $this->spladeTitle('Edit Siswa');

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();

        return view('pages.student.edit', [
            'student' => $student,
            'classrooms' => $classrooms,
        ]);
    }

    public function editgraduate(Student $student)
    {
        $this->spladeTitle('Edit Alumni');

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();

        return view('pages.student-graduate.edit', [
            'student' => $student,
            'classrooms' => $classrooms,
        ]);
    }

    public function show($id)
    {
        $this->spladeTitle('Detail Siswa');

        $student = Student::findOrFail($id);


        return view('pages.student.show', [
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();
        $validated['classroom_id'] = $validated['classroom_id']; // Tetapkan classroom_id dari class_id
        unset($validated['class_id']); // Hapus class_id jika tidak diperlukan

        $student->update($validated);
        Toast::success('Siswa updated successfully!')->autoDismiss(5);

        return redirect()->route('student.index');
    }

    public function updategraduate(UpdateStudentRequest $request, Student $student)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();
        $validated['classroom_id'] = $validated['classroom_id']; // Tetapkan classroom_id dari class_id
        unset($validated['class_id']); // Hapus class_id jika tidak diperlukan

        $student->update($validated);
        Toast::success('Student updated successfully!')->autoDismiss(5);

        return redirect()->route('student.graduate');
    }

    public function destroy(Student $student)
    {
        // $this->authorize('delete', \App\Models\User::class);

        DB::transaction(function () use ($student) {
            $user = $student->user;
            $student->delete();
            if ($user) {
                $user->delete();
            }
        });
    
        Toast::success('Siswa deleted successfully!')->autoDismiss(5);
    
        return redirect()->route('student.index');
    }

    public function import(Request $request)
    {
        // Cek apakah ada file yang diupload
        if (!$request->hasFile('import')) {
            Toast::danger('Tidak ada file yang dipilih!')->autoDismiss(5);
            return redirect()->route('classes.index');
        }

        try{
            // dd($request->import);
            set_time_limit(300);
            Excel::import(new StudentsImport, $request->file('import'));
            Toast::success('Student import successfully!')->autoDismiss(5);
            return redirect()->route('student.index');
        }catch(\Exception $ex){
            Log::info($ex);
            Toast::danger( $ex)->autoDismiss(5);
            return redirect()->route('student.index');

        }

    }

    public function graduate()
    {
        $this->spladeTitle('Siswa');

        // dd($schoolYears);
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.student-graduate.index', [
            'students' => StudentGraduate::class,
        ]);

    }
}
