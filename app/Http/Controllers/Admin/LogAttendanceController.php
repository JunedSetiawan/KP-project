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
    $classroom = Classroom::where('id', $classroom_id)->first();
    // Pastikan classroom ditemukan
    if (!$classroom) {
        return redirect()->route('attendance.index')->with('error', 'Classroom not found.');
    }

    // Ambil data siswa dari classroom
    $students = $classroom->students;
    // Return the view with the log attendance table
    return view('pages.logattendance.list', [
        'logattendances' => $logattendances,
        'date' => $date,
        'classroom' => $classroom,
        'students' => $students,
    ]);
}

public function exportPdf(Request $request, $classId = null)
{
    // Set defaults to current month and year if not provided
    $month = $request->input('month');
    $year = $request->input('year');
    $day = date('d');

    // Get the name of the month for display
    $monthName = Carbon::createFromDate($year, $month, 1)->format('F');

    // Get the number of days in the month
    $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

    // Retrieve unique student attendance records for the specified month and class
    $attendances = LogAttendance::with('student', 'classroom')
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->when($classId, function ($query) use ($classId) {
            return $query->where('classrooms_id', $classId); // Filter by class_id if provided
        })
        ->get()
        ->groupBy('student_id'); // Group by student_id to avoid duplication

    // Check if attendances collection is empty
    if ($attendances->isEmpty()) {

        return redirect()->back()->with('error', "Tidak ada data absensi untuk bulan $monthName $year.");
    }

    // Count the total number of male (L) and female (P) students
    $totalL = 0; // Male (Laki-laki)
    $totalP = 0; // Female (Perempuan)

    foreach ($attendances as $studentId => $attendanceRecords) {
        // Make sure attendanceRecords is not empty
        if ($attendanceRecords->isNotEmpty()) {
            $student = $attendanceRecords->first()->student;
            if ($student->gender === 'L') {
                $totalL++;
            } elseif ($student->gender === 'P') {
                $totalP++;
            }
        }
    }

    // Pass the totals along with other variables to the view
    $pdf = PDF::loadView('pdf.attendance', compact('attendances', 'month', 'year', 'monthName', 'daysInMonth', 'day', 'totalL', 'totalP'))
        ->setPaper('a4', 'landscape');

    // Return the PDF as a download response
    return $pdf->download('Laporan-Daftar-Hadir-' . $month . '-' . $year . '.pdf');
}


}
