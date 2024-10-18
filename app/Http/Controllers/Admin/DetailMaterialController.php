<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailMaterial\DetailMaterialRequest;
use App\Models\DetailMaterial;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;


class DetailMaterialController extends Controller
{
    public function index($material_id)
    {
        $this->spladeTitle('Detail Materi');

        $detailMaterial = DetailMaterial::with('material')->where('material_id', $material_id)->first();

        return view('pages.detailmaterial.index', [
            'detailMaterial' => $detailMaterial,  // Pass detailMaterial to the view
            'material_id' => $material_id         // Also pass the material ID for button action
        ]);
    }

    public function create($material_id)
    {
        $this->spladeTitle('Buat Detail Materi');

        return view('pages.detailmaterial.create', [
            'material_id' => $material_id
        ]);
    }

    public function store(DetailMaterialRequest $request)
    {
        $filename = null;

        // Validasi file harus PDF
        $validated = $request->validate([
            'file' => 'required|mimes:pdf|max:9048', // validasi untuk PDF dengan maksimal ukuran 9MB
        ]);

        if ($request->hasFile('file')) {
            // Ambil file
            $file = $request->file('file');

            // Ambil nama asli file tanpa ekstensi
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // Buat slug dari nama file asli
            $slugName = Str::slug($originalName);

            // Ambil ekstensi asli file
            $ext = $file->getClientOriginalExtension();

            // Simpan file dengan slug name dan ekstensi asli
            $path = $file->storeAs('public/files', $slugName . '.' . $ext);

            // Ambil nama file yang disimpan (beserta ekstensi)
            $filename = pathinfo($path, PATHINFO_BASENAME);
        }
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();
        $validated['file'] = $filename;

        $detailMaterial = DetailMaterial::create($validated);

        Toast::success('Detail materi berhasil ditambahkan!')->autoDismiss(5);

        return redirect()->route('detailmaterial.index', $detailMaterial->material_id);
    }

    public function destroy(DetailMaterial $detailMaterial)
    {
        $detailMaterial->delete();

        Toast::success('Detail materi berhasil dihapus!')->autoDismiss(5);

        return redirect()->route('material.index');
    }
}
