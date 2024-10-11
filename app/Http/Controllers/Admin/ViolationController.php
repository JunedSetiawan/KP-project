<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tables\Violations;
use Illuminate\Http\Request;

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
}
