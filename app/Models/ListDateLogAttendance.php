<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListDateLogAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'classrooms_id',
        'information',
        'note',
    ];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classrooms_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'student_id', 'id');
    }
}
