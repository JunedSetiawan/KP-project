<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Achievement\AchievementRequest;
use App\Http\Requests\Achievement\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Models\Classroom;
use App\Models\Student;
use App\Tables\Achievements;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class AchievementController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Prestasi');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.achievement.index', [
            'achievements' => Achievements::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Pelanggaran');
        $achievement = Achievement::all();

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();
        return view('pages.achievement.create', [
            'achievement' => $achievement,
            'classrooms' => $classrooms
        ]);
    }

    public function store(AchievementRequest $request)
    {

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $data = $request->file('image')->store('public/images');
            $filename = pathinfo($data, PATHINFO_FILENAME) . '.' . $ext;
        }

        $validated = $request->validated();

        $validated['image'] = $filename ?? null;

        $achievement = Achievement::create($validated);


        Toast::message('Created Prestasi Successfully!')->autoDismiss(5);

        return redirect()->route('achievement.index');
    }

    public function edit(Achievement $achievement)
{
    $this->spladeTitle('Edit Pelanggaran');

    // Ambil siswa yang terkait dengan pelanggaran
    $student = Student::with('classroom')->find($achievement->student_id);

    // Ambil semua kelas
    $classroom = $student->classroom->name;

    // Ambil siswa yang ada di kelas yang terkait dengan pelanggaran
    $students = Student::query()->pluck('name', 'id')->toArray();

    // dd( $violation->evidence);

    return view('pages.achievement.edit', [
        'achievement' => $achievement,
        'classroom' => $classroom,  // Kirim daftar kelas ke view
        'students' => $student,      // Kirim daftar siswa dari kelas terkait ke view
        'imageUrl' => $achievement->image ? asset('storage/' . $achievement->image) : null,
        'selectedClassroom' => $student->classroom_id, // Kirim ID kelas yang dipilih
    ]);
}

    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $achievement->update($validated);

        Toast::success('Prestasi berhasil diperbarui!')->autoDismiss(5);

        return redirect()->route('achievement.index');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        Toast::success('Pestasi Berhasil Dihapus!')->autoDismiss(5);

        return redirect()->route('achievement.index');
    }
}
