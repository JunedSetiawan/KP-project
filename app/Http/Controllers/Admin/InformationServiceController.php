<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
