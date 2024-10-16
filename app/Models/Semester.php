<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'name',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function getClassroomNumberAttribute()
    {
        // Mengambil angka saja dari nama kelas seperti "7B", "8B"
        return preg_replace('/[^0-9]/', '', $this->classroom->name);
    }

}
