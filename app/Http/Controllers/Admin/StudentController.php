<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Student;
use App\Tables\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;

class StudentController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Student');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.student.index', [
            'students' => Students::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Create Student');

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
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        // $validated['password'] = Hash::make($validated['password']);
        $validated['classes_id'] = $validated['class_id'];
        unset($validated['class_id']); 
        
        $student = Student::create($validated);

        Toast::success('Student created successfully!')->autoDismiss(5);

        return redirect()->route('student.index');
    }

    public function edit(Student $student)
    {
        $this->spladeTitle('Edit Student');
        
        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();


        return view('pages.student.edit', [
            'student' => $student,
            'classrooms' => $classrooms,
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
        $validated['classroom_id'] = $validated['class_id']; // Tetapkan classroom_id dari class_id
        unset($validated['class_id']); // Hapus class_id jika tidak diperlukan
        
        $student->update($validated);
        Toast::success('Student updated successfully!')->autoDismiss(5);

        return redirect()->route('student.index');
    }

    public function destroy(Student $student)
    {
        // $this->authorize('delete', \App\Models\User::class);

        $student->delete();

        Toast::success('Student deleted successfully!')->autoDismiss(5);

        return redirect()->route('student.index');
    }

    public function import(Request $request) 
    {
        try{
            // dd($request->import);
// 
            Excel::import(new StudentsImport, $request->file('import'));
            Toast::success('Student import successfully!')->autoDismiss(5);
            return redirect()->route('student.index');
        }catch(\Exception $ex){
            Log::info($ex);
            Toast::danger( $ex)->autoDismiss(5);
            return redirect()->route('student.index');

        }
        
    }
}
