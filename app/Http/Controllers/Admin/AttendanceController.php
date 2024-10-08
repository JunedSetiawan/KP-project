<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceRequest;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\LogAttendance;
use App\Models\Student;
use App\Services\FonnteService;
use App\Tables\Attendances;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class AttendanceController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }


    public function index()
    {
        $this->spladeTitle('Daftar Hadir');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.attendance.index', [
            'attendances' => Attendances::class,
        ]);
    }

    public function create($id)
    {
        $this->spladeTitle('Create Daftar Hadir');

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



    public function store(UpdateAttendanceRequest $request)
{
    // Validasi data
    $validated = $request->validated();

    // Simpan data ke tabel Attendance
    $attendance = Attendance::create($validated);

    // Simpan data ke tabel LogAttendance

    // Menampilkan pesan sukses
    Toast::success('Attendance created successfully!')->autoDismiss(5);

    return redirect()->route('attendance.index');
}


    public function edit(Attendance $attendance)
    {
        $this->spladeTitle('Edit Daftar Hardir');

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
    $this->spladeTitle('List Daftar Hadira');

    // Ambil classroom berdasarkan classroom_id dan relasi dengan students serta teacher
    $classroom = Classroom::with(['students', 'teacher'])->find($classroom_id);

    // Pastikan classroom ditemukan
    if (!$classroom) {
        Toast::warning("Kelas tidak ada")->autoDismiss(5);
        return redirect()->route('attendance.index')->with('error', 'Classroom not found.');
    }

    if($classroom->students->isEmpty()) {
        Toast::warning("Kelas $classroom->name tidak ada memiliki siswa")->autoDismiss(5);
        return redirect()->route('attendance.index');
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

    $date = Carbon::now()->locale('id');

    // Kirim classroom dan koleksi siswa ke view
    return view('pages.attendance.list', [
        'classroom' => $classroom,
        'students' => $students,
        'date' => $date
    ]);
}




public function submitAll(Request $request, Classroom $classroom)
{
    // Check if any attendance data is missing
    $missingAttendance = false;

    // Loop through the attendance data
    foreach ($request->attendance as $studentId => $data) {
        if (!isset($data['status'])) {
            $missingAttendance = true;
            break;
        }
    }

    // If there's missing attendance data, redirect back with an error message
    if ($missingAttendance) {
        return redirect()->back()->with('error', 'Data absensi belum diisi untuk beberapa siswa.');
    }
    $attendanceData = [];
    $messageSentCount = 0;

    foreach ($request->attendance as $studentId => $data) {
        $attendanceData[] = [
            'student_id' => $studentId,
            'date' => Carbon::today(),
            'classrooms_id' => $classroom->id,
            'information' => $data['status'],
            'note' => $data['note'] ?? null,
        ];

        if ($data['status'] == 'A') {
            $student = Student::find($studentId);
            if ($student && $student->phone_number_parent) {
                try {
                    $message = "Halo Orang tua murid dari {$student->name}, tidak memasuki kelas hari ini. Terima kasih. :)";
                    $this->fonnte->sendMessage($student->phone_number_parent, $message);
                    $messageSentCount++;
                } catch (\Exception $e) {
                    // Log error
                    Log::error("Failed to send message to student {$student->id}: " . $e->getMessage());
                }
            }
        }

    }



    // Bulk insert attendance data
    Attendance::insert($attendanceData);
    LogAttendance::insert($attendanceData);

    Toast::success("Attendance dibuat successfully! {$messageSentCount} pesan dikirim.")->autoDismiss(5);

    // Redirect back with a success message
    return redirect()->route('logattendance.listdate', ['id' => $classroom->id, 'date']);
}




}
