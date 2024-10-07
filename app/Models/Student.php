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
}
