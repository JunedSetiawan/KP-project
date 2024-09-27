<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'gender',
        'phone_number',
        'name_parent',
        'phone_number_parent',
        'phone_number_parent_opt',
        'classes_id',
        'status',
    ];

    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'classes_id');
    }
}
