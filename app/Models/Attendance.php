<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'classes_id',
        'information',
        'note',
    ];

    public function classes()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
