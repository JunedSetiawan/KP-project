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
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

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
        $this->spladeTitle('Tambah Prestasi');
        $achievement = Achievement::all();

        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();
        return view('pages.achievement.create', [
            'achievement' => $achievement,
            'classrooms' => $classrooms
        ]);
    }

    public function store(AchievementRequest $request)
{
    $filename = null;

    if ($request->hasFile('image')) {
        // Ambil file
        $file = $request->file('image');

        // Ambil ekstensi asli file
        $ext = $file->getClientOriginalExtension();

        // Buat nama acak untuk file tanpa ekstensi
        $randomName = pathinfo($file->hashName(), PATHINFO_FILENAME);

        // Simpan file dengan nama acak dan ekstensi asli
        $path = $file->storeAs('public/images', $randomName . '.' . $ext);

        // Ambil nama file yang disimpan (beserta ekstensi)
        $filename = pathinfo($path, PATHINFO_BASENAME);
    }

    // Validasi dan buat prestasi
    $validated = $request->validated();
    $validated['image'] = $filename;

    $achievement = Achievement::create($validated);

    // Tampilkan pesan berhasil
    Toast::message('Created Prestasi Successfully!')->autoDismiss(5);

    return redirect()->route('achievement.index');
}

    public function edit(Achievement $achievement)
{
    $this->spladeTitle('Edit Prestasi');

    // Ambil siswa yang terkait dengan prestasi
    $student = Student::with('classroom')->find($achievement->student_id);

    // Ambil semua kelas
    $classroom = $student->classroom->name;

    // Ambil siswa yang ada di kelas yang terkait dengan prestasi
    $students = Student::query()->pluck('name', 'id')->toArray();

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
         
        $achievement->delete();

        Toast::success('Prestasi Berhasil Dihapus!')->autoDismiss(5);

        return redirect()->route('achievement.index');
    }
}
