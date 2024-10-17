<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\MaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\Semester;
use App\Tables\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    DB::transaction(function () use ($material) {
        // First delete all associated detail materials
        if ($material->detailMaterial) {
            // Delete file if exists
            if ($material->detailMaterial->file) {
                $filePath = 'files/' . $material->detailMaterial->file;
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            // Delete the detail material record
            $material->detailMaterial->delete();
        }
        
        // Then delete the material
        $material->delete();
    });

    Toast::success('Materi berhasil dihapus!')->autoDismiss(5);
    return redirect()->route('material.index');
}

public function klasikal()
    {
        $this->spladeTitle('Klasikal');
        return view('pages.klasikal');
    }
    public function kelas7() {
        $materiGanjil = Material::where('semester_id', 1)->get();
        $materiGenap = Material::where('semester_id', 2)->get();
    
        return view('pages.kelas7', compact('materiGanjil', 'materiGenap'));
    }
    
    
    public function kelas8() {
        $materiGanjil = Material::where('semester_id', 1)->get();
        $materiGenap = Material::where('semester_id', 2)->get();
    
        return view('pages.kelas8', compact('materiGanjil', 'materiGenap'));
    }
    
    public function kelas9() {
        $materiGanjil = Material::where('semester_id', 1)->get();
        $materiGenap = Material::where('semester_id', 2)->get();
    
        return view('pages.kelas9', compact('materiGanjil', 'materiGenap'));
    }

    public function show($id) {
        $materi = Material::findOrFail($id);
        return view('pages.detail-materi', compact('materi'));
    }

}