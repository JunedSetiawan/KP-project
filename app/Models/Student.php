<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nipd',
        'nisn',
        'name',
        'gender',
        'phone_number',
        'name_parent',
        'phone_number_parent',
        'phone_number_parent_opt',
        'classroom_id',
        'status',
        'school_year_id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class,  'school_year_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getAttendanceForDate($date)
{
    // Fetch the attendance record for the student on a specific date
    $attendance = LogAttendance::where('student_id', $this->id)
        ->where('date', $date)
        ->first();

    // Return the attendance information (V, S, I, A) or a default value (e.g., '-')
    return $attendance ? $attendance->information : '-';
}

public function logAttendances()
    {
        return $this->hasMany(LogAttendance::class, 'student_id');
    }

}
