<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDocument extends Model
{
    use HasFactory;


      /**
     * les users medecin qui ont accés au dossier medicals
     */
    public function doctors()
    {
        return $this->belongsToMany(User::class, "medical_doctor", "medical_id", "doctor_id");
    }

    public function patient()
    {
        return $this->belongsTo(User::class, "patient_id");
    }

    
}
