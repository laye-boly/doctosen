<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointement extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function doctor()
    {
        return $this->belongsTo(User::class, "doctor_id");
    }

    public function patient()
    {
        return $this->belongsTo(User::class, "patient_id");
    }
}
