<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\ClassesRequest;
use App\Http\Requests\Classes\UpdateClassesRequest as ClassesUpdateClassesRequest;
use App\Models\Classroom;
use App\Tables\Classrooms;
use App\Imports\ClassesImport;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;


class ClassesController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Kelas');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.classes.index', [
            'classrooms' => Classrooms::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Kelas');
        $classrooms = [
            '7' => '7',
            '8' => '8',
            '9' => '9',
        ];

        $type = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
            'G' => 'G',
            'H' => 'H',
            'I' => 'I',
        ];
        $teacher = Teacher::all();

        return view('pages.classes.create', [
            'classrooms' => $classrooms,
            'types' => $type,
            'teacher' => $teacher,
        ]);
    }

    public function store(ClassesRequest $request)
    {

        // Data yang sudah tervalidasi
        $validated = $request->validated();

        // check if name is duplcate or unique
        $check = Classroom::where('name', $validated['name'])->first();

        if ($check) {
            Toast::warning("Data Kelas $check->name Sudah ada")->autoDismiss(5);
            return redirect()->route('classes.index');
        }

        // Simpan ke database dengan gabungan kelas dan tipe kelas di kolom name
        $class = Classroom::create([
            'name' => $validated['name'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        // Tampilkan pesan sukses
        Toast::success("Data Kelas $class->name Berhasil dibuat")->autoDismiss(5);
        return redirect()->route('classes.index');
    }


    public function edit(Classroom $classes)
    {
        $this->spladeTitle('Edit Kelas');
        $teacher = Teacher::all();
        // $classes = Classroom::all();
        return view('pages.classes.edit', [
            'classes' => $classes,
            'teacher' => $teacher,
        ]);
    }

    public function update(ClassesUpdateClassesRequest $request, Classroom $classes)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $check = $classes::where('name', $validated['name'])->first();

        if ($check) {
            Toast::warning("Data Kelas $check->name Sudah ada")->autoDismiss(5);
            return redirect()->route('classes.index');
        }

        $classes->update($validated);


        Toast::success('Classes updated successfully!')->autoDismiss(5);

        return redirect()->route('classes.index');
    }

    public function destroy(Classroom $classes)
    {
        // $this->authorize('delete', \App\Models\User::class);

        $classes->delete();

        Toast::success('Classes deleted successfully!')->autoDismiss(5);

        return redirect()->route('classes.index');
    }

    public function import(Request $request)
    {
        // Cek apakah ada file yang diupload
        if (!$request->hasFile('import')) {
            Toast::danger('Tidak ada file yang dipilih!')->autoDismiss(5);
            return redirect()->route('classes.index');
        }
        
        try {
            // dd($request->import);
            //
            Excel::import(new ClassesImport, $request->file('import')->store('files'));
            Toast::success('classes import successfully!')->autoDismiss(5);
            return redirect()->route('classes.index');
        } catch (\Exception $ex) {
            Log::info($ex);
            Toast::danger($ex)->autoDismiss(5);
            return redirect()->route('classes.index');
        }
    }
}
