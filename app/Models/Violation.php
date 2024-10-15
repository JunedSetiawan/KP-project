<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'violation',
        'note',
        'image',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
