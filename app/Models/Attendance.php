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
        'classrooms_id',
        'information',
        'note',
    ];

    public static function boot()
    {
        parent::boot();

        // Event Eloquent untuk 'created'
        static::created(function ($attendance) {
            // Simpan data ke LogAttendance setelah Attendance dibuat
            LogAttendance::create([
                'student_id' => $attendance->student_id,
                'date' => $attendance->date,
                'classrooms_id' => $attendance->classrooms_id,
                'information' => $attendance->information,
                'note' => $attendance->note,
            ]);
        });
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classrooms_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'student_id', 'id');
    }
}

