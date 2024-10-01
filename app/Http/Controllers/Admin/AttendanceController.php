<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\LogAttendance;
use App\Tables\Attendances;
use Carbon\Carbon;
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

    // Validasi data
    $validated = $request->validated();

    // Simpan data ke tabel Attendance
    $attendance = Attendance::create($validated);

    // Buat log attendance
    LogAttendance::create([
        'student_id' => $attendance->student_id,
        'date' => Carbon::today(),
        'classrooms_id' => $attendance->classrooms_id,
        'information' => $validated['status'], // Atur status sebagai informasi
        'note' => $validated['note'] ?? null, // Catatan bisa opsional
    ]);

    // Menampilkan pesan sukses
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
    // Set judul halaman menggunakan Splade
    $this->spladeTitle('List Attendance');

    // Ambil classroom berdasarkan classroom_id dan relasi dengan students serta teacher
    $classroom = Classroom::with(['students', 'teacher'])->find($classroom_id);

    // Pastikan classroom ditemukan
    if (!$classroom) {
        // Jika classroom tidak ditemukan, redirect dengan pesan error
        return redirect()->route('attendance.index')->with('error', 'Classroom not found.');
    }

    // Cek apakah absensi sudah diisi untuk hari ini
    $attendanceExists = Attendance::where('classrooms_id', $classroom_id)
        ->whereDate('date', Carbon::today())
        ->exists();

    // Jika absensi sudah diisi untuk hari ini, redirect dengan pesan
    if ($attendanceExists) {
        Toast::warning("Daftar hadir untuk kelas $classroom->name sudah terisi")->autoDismiss(5);
        return redirect()->route('attendance.index');
    }

    // Ambil semua siswa terkait dengan classroom
    $students = $classroom->students;

    // Kirim classroom dan koleksi siswa ke view
    return view('pages.attendance.list', [
        'classroom' => $classroom,
        'students' => $students,
    ]);
}




public function submitAll(Request $request, Classroom $classroom)
{
    // Loop through each student's attendance data
    foreach ($request->attendance as $studentId => $attendanceData) {
        // Update or create the attendance record for the student
        Attendance::updateOrCreate(
            [
                'student_id' => $studentId, 
                'classrooms_id' => $classroom->id, 
                'date' => Carbon::today()
            ],
            [
                'status' => $attendanceData['status'], 
                'note' => $attendanceData['note'] ?? null,
                'information' => $attendanceData['status'] // Menggunakan status sebagai informasi
            ]
        );
    }
    Toast::success('Attendance dibuat successfully!')->autoDismiss(5);

    // Redirect back with a success message
    return redirect()->route('attendance.index');
}




}
