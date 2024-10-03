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
        switch ($value) {
            case 'V':
                return 'Hadir';
            case 'S':
                return 'Sakit';
            case 'I':
                return 'Ijin';
            case 'A':
                return 'Alpha';
            default:
                return $value; // Fallback if none of the cases match
        }
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classrooms_id', 'id');
    }

    public function student()
{
    return $this->belongsTo(Student::class, 'student_id', 'id');
}

}
