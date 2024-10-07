<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'classrooms_id',
        'information',
        'note',
    ];

    public function getInformationAttribute($value)
    {
        return $value; // Returns 'V', 'S', 'I', 'A' directly
    }

    // New method to get the full description
    public function getFullInformation()
    {
        switch ($this->information) {
            case 'V':
                return 'Hadir';
            case 'S':
                return 'Sakit';
            case 'I':
                return 'Ijin';
            case 'A':
                return 'Tanpa Keterangan'; // Changed to "Tanpa Keterangan"
            default:
                return $this->information; // Fallback if none of the cases match
        }
    }

    public function classroom()
{
    return $this->belongsTo(Classroom::class, 'classrooms_id'); // Adjust the foreign key as necessary
}


    public function student()
{
    return $this->belongsTo(Student::class);
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



}
