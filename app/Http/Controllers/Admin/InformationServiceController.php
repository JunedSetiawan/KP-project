<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Tables\InformationServices;
use Illuminate\Http\Request;

class InformationServiceController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Daftar Layanan Informasi');
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.informationservice.index', [
            'informationservices' => InformationServices::class,
        ]);
    }

    public function public()
    {
        $this->spladeTitle('Layanan Informasi');
        $classrooms = Classroom::query()->pluck('name', 'id')->toArray();
        $teachers = Teacher::where('type', 'BK')->pluck('name', 'id')->toArray();
        // $this->authorize('viewAny', \App\Models\Classes::class);
        return view('pages.public', [
            'teachers' => $teachers,
            'classrooms' => $classrooms
        ]);
    }
}
