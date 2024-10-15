<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Violation\UpdateViolationRequest;
use App\Http\Requests\Violation\ViolationRequest;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Violation;
use App\Tables\Violations;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class ViolationController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Pelanggaran');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.violation.index', [
            'violations' => Violations::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Pelanggaran');
        $violation = Violation::all();

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();
        return view('pages.violation.create', [
            'violation' => $violation,
            'classrooms' => $classrooms
        ]);
    }

    public function store(ViolationRequest $request)
    {

        if ($request->hasFile('evidence')) {
            $ext = $request->file('evidence')->getClientOriginalExtension();
            $data = $request->file('evidence')->store('public/images');
            $filename = pathinfo($data, PATHINFO_FILENAME) . '.' . $ext;
        }

        $validated = $request->validated();

        $validated['evidence'] = $filename ?? null;

        $violation = Violation::create($validated);


        Toast::message('Created Violation Successfully!')->autoDismiss(5);

        return redirect()->route('violation.index');
    }

    public function edit(Violation $violation)
{
    $this->spladeTitle('Edit Pelanggaran');

    // Ambil siswa yang terkait dengan pelanggaran
    $student = Student::with('classroom')->find($violation->student_id);

    // Ambil semua kelas
    $classroom = $student->classroom->name;

    // Ambil siswa yang ada di kelas yang terkait dengan pelanggaran
    $students = Student::query()->pluck('name', 'id')->toArray();

    // dd( $violation->evidence);

    return view('pages.violation.edit', [
        'violation' => $violation,
        'classroom' => $classroom,  // Kirim daftar kelas ke view
        'students' => $student,      // Kirim daftar siswa dari kelas terkait ke view
        'evidenceUrl' => $violation->evidence ? asset('storage/' . $violation->evidence) : null,
        'selectedClassroom' => $student->classroom_id, // Kirim ID kelas yang dipilih
    ]);
}

    public function update(UpdateViolationRequest $request, Violation $violation)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $violation->update($validated);

        Toast::success('Pelanggaran berhasil diperbarui!')->autoDismiss(5);

        return redirect()->route('violation.index');
    }

    public function destroy(Violation $violation)
    {
        $violation->delete();

        Toast::success('Violation deleted successfully!')->autoDismiss(5);

        return redirect()->route('violation.index');
    }


}
