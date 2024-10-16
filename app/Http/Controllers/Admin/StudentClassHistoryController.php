<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tables\StudentClassHistorys;
use Illuminate\Http\Request;

class StudentClassHistoryController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Riwayat Data Kelas');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.studentclasshistory.index', [
            'studentclasshistorys' => StudentClassHistorys::class,
        ]);
    }
}
