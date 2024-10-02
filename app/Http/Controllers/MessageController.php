<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    public function send()
    {
        $users = Student::query()->limit(3)->get();

        foreach ($users as $key => $user) {
            $to = $user->phone_number;
            $message = 'Halo selamat datang, ini hanya pesan testing';
            $response = $this->fonnte->sendMessage($to, $message);
            return response()->json($response);
        }
    }
}
