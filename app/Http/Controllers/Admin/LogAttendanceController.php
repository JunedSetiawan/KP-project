<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ListDateLogAttendance;
use App\Models\LogAttendance;
use App\Models\Student;
use App\Tables\LogAttendances;
use App\Tables\ListDateLogAttendances;
use App\Tables\ListLogAttendances;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Barryvdh\DomPDF\Facade\Pdf;

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

public function exportPdf($month = null, $year = null)
{
    // Set defaults to current month and year if not provided
    $month = $month ?: date('m');
    $year = $year ?: date('Y');

    // Get the name of the month for display
    $monthName = Carbon::createFromDate($year, $month, 1)->format('F');

    // Get the number of days in the month
    $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

    // Retrieve unique student attendance records for the specified month
    $attendances = LogAttendance::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->with('student') // Eager load the student relationship
        ->get()
        ->groupBy('student_id'); // Group by student_id to avoid duplication

    // Load the view and pass necessary data
    $pdf = PDF::loadView('pdf.attendance', compact('attendances', 'month', 'year', 'monthName', 'daysInMonth'))
        ->setPaper('a4', 'landscape');

    // Return the PDF as a download response
    return $pdf->download('attendance-report-' . $month . '-' . $year . '.pdf');
}








    
}
