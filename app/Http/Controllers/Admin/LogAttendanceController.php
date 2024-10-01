<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\LogAttendance;
use App\Tables\LogAttendances;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class LogAttendanceController extends Controller
{
    public function index()
    {
        $this->spladeTitle('LogAttendance');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.logattendance.index', [
            'logattendances' => LogAttendances::class,
        ]);
    }

    public function store(LogAttendance $request)
    {
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        // $validated['password'] = Hash::make($validated['password']);
        
        $logattendance = LogAttendance::create($validated);

        Toast::success('School Year created successfully!')->autoDismiss(5);

        return redirect()->route('logattendance.index');
    }

    public function listdate($classroom_id)
    {
        // Set judul halaman menggunakan Splade
        $this->spladeTitle('List Attendance');
    
        // Ambil classroom berdasarkan classroom_id
        $classroom = Classroom::with('students', 'teacher')->find($classroom_id);
    
        // Pastikan classroom ditemukan
        if (!$classroom) {
            return redirect()->route('attendance.index')->with('error', 'Classroom not found.');
        }
    
        // Ambil semua tanggal absensi unik dari log_attendances berdasarkan classroom_id
        $attendanceDates = LogAttendance::where('classrooms_id', $classroom_id)
            ->select('date')
            ->distinct()
            ->orderBy('date', 'asc')
            ->get();
    
        // Kirim classroom dan tanggal absensi ke view
        return view('pages.logattendance.listdate', [
            'classroom' => $classroom,
            'attendanceDates' => $attendanceDates,
        ]);
    }
    
}
