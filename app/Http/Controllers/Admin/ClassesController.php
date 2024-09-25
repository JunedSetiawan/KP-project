<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\ClassesRequest;
use App\Http\Requests\Classes\UpdateClassesRequest as ClassesUpdateClassesRequest;
use App\Models\Classes;
use App\Models\Classroom;
use App\Tables\Classrooms;
use App\Imports\ClassesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;


class ClassesController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Classes');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.classes.index', [
            'classrooms' => Classrooms::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Create Classrom');
        $classes = Classroom::all();
        return view('pages.classes.create', [
           'classes' => $classes,
        ]);
    }

    public function store(ClassesRequest $request)
    {
        // $this->authorize('create', \App\Models\User::class);
        $validated = $request->validate([
            'name' => 'required',
        ]);
        
        $classes = Classroom::create($validated);
        Toast::success('Student created successfully!')->autoDismiss(5);
        return redirect()->route('classes.index');
    }

    public function edit(Classroom $classes)
    {
        $this->spladeTitle('Edit Classroom');
        // $classes = Classroom::all();
        return view('pages.classes.edit', [
            'classes' => $classes,
        ]);
    }

    public function update(ClassesUpdateClassesRequest $request, Classroom $classes)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

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
        try{
            // dd($request->import);
// 
            Excel::import(new ClassesImport, $request->file('import')->store('files'));
            Toast::success('classes import successfully!')->autoDismiss(5);
            return redirect()->route('classes.index');
        }catch(\Exception $ex){
            Log::info($ex);
            Toast::danger( $ex)->autoDismiss(5);
            return redirect()->route('classes.index');

        }
        
    }
}
