<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Tables\Attendances;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

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

    public function create()
    {
        $this->spladeTitle('Create Attendance');

        // $roles = [
        //     'sales' => 'Sales',
        //     'purchase' => 'Purchase',
        //     'manager' => 'Manager',
        // ];

        return view('pages.student.create', [
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
}
