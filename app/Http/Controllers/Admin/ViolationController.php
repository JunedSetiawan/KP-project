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
use Illuminate\Support\Facades\Storage;
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

    // Validasi dan buat pelanggaran
    $validated = $request->validated();
    $validated['image'] = $filename;

    $violation = Violation::create($validated);

    // Tampilkan pesan berhasil
    Toast::message('Data Pelanggaran berhasil dibuat!')->autoDismiss(5);

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

    // dd( $violation->image);

    return view('pages.violation.edit', [
        'violation' => $violation,
        'classroom' => $classroom,  // Kirim daftar kelas ke view
        'students' => $student,      // Kirim daftar siswa dari kelas terkait ke view
        'imageUrl' => $violation->image ? asset('storage/' . $violation->image) : null,
        'selectedClassroom' => $student->classroom_id, // Kirim ID kelas yang dipilih
    ]);
}

public function update(UpdateViolationRequest $request, Violation $violation)   
{
    // Update data pelanggaran
    $violation->violation = $request->input('violation');
    $violation->note = $request->input('note');

    // Jika ada file gambar baru yang diunggah
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($violation->image) {
            $filePath = 'images/' . $violation->image;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        // Ambil file baru
        $file = $request->file('image');
        // Ambil ekstensi asli file
        $ext = $file->getClientOriginalExtension();
        // Buat nama acak untuk file tanpa ekstensi
        $randomName = pathinfo($file->hashName(), PATHINFO_FILENAME);
        // Simpan file dengan nama acak dan ekstensi asli
        $path = $file->storeAs('public/images', $randomName . '.' . $ext);
        // Ambil nama file yang disimpan (beserta ekstensi)
        $filename = pathinfo($path, PATHINFO_BASENAME);

        // Simpan nama file baru ke database
        $violation->image = $filename;
    } else {
        // Jika tidak ada file gambar baru, tetapi ada gambar lama yang dipilih
        if ($request->image_existing) {
            $violation->image = $request->image_existing;
        }
    }

    // Simpan data pelanggaran
    $violation->save();

    Toast::message('Data Pelanggaran berhasil diubah!')->autoDismiss(5);

    return redirect()->route('violation.index');
}


    public function destroy(Violation $violation)
    {

        $filePath = 'images/' . $violation->image;

        if (Storage::disk('public')->exists($filePath)) {

            Storage::disk('public')->delete($filePath);
        }

        $violation->delete();

        Toast::success('Data Pelanggaran berhasil dihapus!')->autoDismiss(5);

        return redirect()->route('violation.index');
    }


}
