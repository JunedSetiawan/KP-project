<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ListDateLogAttendance;
use App\Models\LogAttendance;
use App\Tables\LogAttendances;
use App\Tables\ListDateLogAttendances;
use App\Tables\ListLogAttendances;
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

    // Buat instance ListDateLogAttendances secara manual dengan classroom_id
    $logattendances = new ListDateLogAttendances($classroom_id);

    // Kirim classroom dan tanggal absensi ke view
    return view('pages.logattendance.listdate', [
        'classroom' => $classroom,
        'attendanceDates' => $attendanceDates,
        'logattendances' => $logattendances,
    ]);
}


public function list($classroom_id, $date)
{
    $this->spladeTitle('Daftar Kehadiran tanggal : ' . $date);

    // Create an instance of the ListLogAttendances table with classroom_id and date
    $logattendances = new ListLogAttendances($classroom_id, $date);

    // Return the view with the log attendance table
    return view('pages.logattendance.list', [
        'logattendances' => $logattendances,
        'date' => $date,
    ]);
}






    
}
