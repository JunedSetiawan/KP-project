<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'semester_id',
    ];

    public function semester()
{
    return $this->belongsTo(Semester::class); 
}

// Relasi ke DetailMaterial, mengganti belongsTo menjadi hasOne
public function detailMaterial()
{
    return $this->hasOne(DetailMaterial::class, 'material_id');
}

public function getFormattedSemesterAttribute()
{
    // Menggunakan accessor 'classroom_number' untuk mengambil angka kelas
    return $this->semester->classroom_number . '-' . $this->semester->name;
}
}
