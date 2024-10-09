<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationService extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'date',
        'student_id',
        'note',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
