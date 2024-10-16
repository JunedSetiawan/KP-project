<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'content',
        'file',
        'url_video',
    ];
    // Relasi ke Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

}
