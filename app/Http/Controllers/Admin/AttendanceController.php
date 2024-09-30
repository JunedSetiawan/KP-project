<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use App\Tables\Attendances;
use App\Tables\ListStudents;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class AttendanceController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Attendance');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.attendance.index', [
            'attendances' => Attendances::class,
        ]);
    }

    public function create($id)
    {
        $this->spladeTitle('Create Attendance');

        $attendance = Attendance::with('classrooms')->find($id);

        $class = $attendance->classrooms->students;
        dd($class);

        $classes = Classroom::all();

        // Cek apakah attendance ditemukan dan classroom tersedia
        if ($attendance && $attendance->classrooms) {
            // Ambil semua siswa terkait dengan classroom
            $students = $attendance->classrooms->students;
        } else {
            dd('No attendance or classroom found');
        }
    

        return view('pages.attendance.create', [
            'classes' => $classes,
        ]);
    }



    public function store(Attendance $request)
    {
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        // $validated['password'] = Hash::make($validated['password']);
        
        $attendance = Attendance::create($validated);

        Toast::success('Attendance created successfully!')->autoDismiss(5);

        return redirect()->route('attendance.index');
    }

    public function edit(Attendance $attendance)
    {
        $this->spladeTitle('Edit Attendance');

        return view('pages.attendance.edit', [
            'attendance' => $attendance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $attendance->update($validated);

        Toast::success('Attendance updated successfully!')->autoDismiss(5);

        return redirect()->route('attendance.index');
    }

    public function destroy(Attendance $attendance)
    {
        // $this->authorize('delete', \App\Models\User::class);

        $attendance->delete();

        Toast::success('Attendance deleted successfully!')->autoDismiss(5);

        return redirect()->route('attendance.index');
    }

    public function list($classroom_id)
    {
        $this->spladeTitle('List Attendance');

        $attendance = Attendance::with('classrooms')->find($classroom_id);


        // Cek apakah attendance ditemukan dan classroom tersedia
        if ($attendance && $attendance->classrooms) {
            // Ambil semua siswa terkait dengan classroom
            $students = $attendance->classrooms->students;
        } else {
            dd('No attendance or classroom found');
        }
    

        return view('pages.attendance.list', [
            'students' => SpladeTable::for($students)
            ->column('name', 'Name')
            ->column('registration_number', 'Registration Number')
            ->column('email', 'Email')
            ->searchInput('name', 'Search by Name')
          
        ]);

    }
}
