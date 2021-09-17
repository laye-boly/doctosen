<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccine extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * 
     * Un vaccin de temps peut concerner peut concerner un ou plsusieurs emploi de temps
     * Un emploi de temps, aussi, peut etre lié à plusieurs vaccins 
     * On défint ici une relation many-to-many
     * la relation inverse many-to-many est défini dans le modèle VaccineSchedule.php 
     */
    public function schedules()
    {
        return $this->belongsToMany(VaccineSchedule::class, "vaccines_schedules_vaccines", "vaccine_id", "vaccine_schedule_id");
    }

    /**
     * Inverse de la relation many-to-one avec Hospital
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
