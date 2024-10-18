<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherRequest as TeacherTeacherRequest;
use App\Http\Requests\Teacher\UpdateTeacherRequest as TeacherUpdateTeacherRequest;
use App\Imports\TeachersImport;
use App\Models\Classroom;
use App\Models\User;
use App\Tables\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Guru');
        return view('pages.teacher.index', [
            'teachers' => Teachers::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Guru');
        $classes = Classroom::all();
        return view('pages.teacher.create', [
            'classes' => $classes,
        ]);
    }

    public function store(TeacherTeacherRequest $request)
{
    $validated = $request->validated();

    // Log untuk melihat input yang diterima
    Log::info('Request data:', $validated);

    // Buat user jika tipe adalah BK
    $user = null;
    if ($validated['type'] == 'BK') {
        $user = User::firstOrCreate(
            ['username' => $validated['nip']],
            [
                'name' => $validated['name'],
                'role' => 'user',
                'email' => Str::slug($validated['name']) . '@gmail.com',
                'password' => bcrypt('passbk' . $validated['nip']),
            ]
        );

        // Log untuk melihat apakah user berhasil dibuat
        Log::info('User created or found:', $user->toArray());

        // Tambahkan user_id ke data yang akan disimpan
        $validated['user_id'] = $user->id;
    }

    // Simpan data guru
    $teacher = Teacher::create($validated);

    Toast::success('Data Guru berhasil dibuat!')->autoDismiss(5);

    return redirect()->route('teacher.index');
}


    public function edit(Teacher $teacher)
    {
        $this->spladeTitle('Edit Guru');
        // $classes = Classroom::all();
        return view('pages.teacher.edit', [
            'teacher' => $teacher,
        ]);
    }

    public function update(TeacherUpdateTeacherRequest $request, Teacher $teacher)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $teacher->update($validated);

        Toast::success('Data Guru berhasil diubah!')->autoDismiss(5);

        return redirect()->route('teacher.index');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        Toast::success('Data Guru berhasil dihapus!')->autoDismiss(5);

        return redirect()->route('teacher.index');
    }

    public function import(Request $request)
    {
        // Cek apakah ada file yang diupload
        if (!$request->hasFile('import')) {
            Toast::danger('Tidak ada file yang dipilih!')->autoDismiss(5);
            return redirect()->route('teacher.index');
        }

        try {
            // dd($request->import);
            //
            Excel::import(new TeachersImport, $request->file('import')->store('files'));
            Toast::success('Data Guru berhasil diimport!')->autoDismiss(5);
            return redirect()->route('teacher.index');
        } catch (\Exception $ex) {
            Log::info($ex);
            Toast::danger($ex)->autoDismiss(5);
            return redirect()->route('teacher.index');
        }
    }
}
