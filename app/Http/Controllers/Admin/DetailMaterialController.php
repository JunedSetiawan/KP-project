<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailMaterial\DetailMaterialRequest;
use App\Models\DetailMaterial;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

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

        if ($request->hasFile('file')) {
            // Ambil file
            $file = $request->file('file');

            // Ambil ekstensi asli file
            $ext = $file->getClientOriginalExtension();

            // Buat nama acak untuk file tanpa ekstensi
            $randomName = pathinfo($file->hashName(), PATHINFO_FILENAME);

            // Simpan file dengan nama acak dan ekstensi asli
            $path = $file->storeAs('public/files', $randomName . '.' . $ext);

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
