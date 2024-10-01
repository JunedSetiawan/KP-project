<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClassHistory extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan model ini
    protected $table = 'student_class_history';

    // Kolom-kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'student_id',
        'classroom_id',
    ];

    /**
     * Relasi ke model Student.
     * Setiap history terkait dengan satu student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relasi ke model Classroom.
     * Setiap history terkait dengan satu classroom.
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Relasi ke model SchoolYear.
     * Setiap history terkait dengan satu school year.
     */
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
