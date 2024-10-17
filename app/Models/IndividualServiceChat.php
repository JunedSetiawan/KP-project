<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualServiceChat extends Model
{
    use HasFactory;

    protected $fillable = ['individual_service_id','user_id','body'];

    public function individual_service()
    {
        return $this->belongsTo(IndividualService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
