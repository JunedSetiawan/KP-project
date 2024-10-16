<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\MaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\Semester;
use App\Tables\Materials;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class MaterialController extends Controller
{
    
    public function index()
    {
        $this->spladeTitle('Materi');
        return view('pages.material.index', [
            'materials' => Materials::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Tambah Materi');
        $semesters = Semester::with('classroom')
        ->get()
        ->mapWithKeys(function ($semester) {
            // Ambil hanya angka dari nama kelas
            $classNumber = preg_replace('/[^0-9]/', '', $semester->classroom->name);
            return [$semester->id => $classNumber . ' - ' . $semester->name];
        })
        ->toArray();
    
        return view('pages.material.create', [
            'semesters' => $semesters
        ]);
    }

    public function store(MaterialRequest $request)
    {
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        $material = Material::create($validated);

        Toast::success('Materi berhasil dibuat!')->autoDismiss(5);

        return redirect()->route('material.index');
    }

    public function edit(Material $material)
    {
        $this->spladeTitle('Edit Materi');

        $semesters = Semester::with('classroom')
        ->get()
        ->mapWithKeys(function ($semester) {
            // Ambil hanya angka dari nama kelas
            $classNumber = preg_replace('/[^0-9]/', '', $semester->classroom->name);
            return [$semester->id => $classNumber . ' - ' . $semester->name];
        })
        ->toArray();
        // $classes = Classroom::all();
        return view('pages.material.edit', [
            'material' => $material,
            'semesters' => $semesters,
        ]);
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $material->update($validated);


        Toast::success('Materi berhasil diubah!')->autoDismiss(5);

        return redirect()->route('material.index');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        Toast::success('Materi berhasil dihapus!')->autoDismiss(5);

        return redirect()->route('material.index');
    }

}