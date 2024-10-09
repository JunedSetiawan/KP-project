<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'is_active',
        'type',
        // 'wali_kelas',
    ];

    // public function teacher()
    // {
    //     return $this->hasMany(Teacher::class);
    // }
}
