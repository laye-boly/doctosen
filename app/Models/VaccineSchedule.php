<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineSchedule extends Model
{
    use HasFactory;

    /**
     * 
     * Un emploi de temps peut concerner peut concerner un ou plsusieurs vaccins
     * Un vaccin, aussi, peut etre lié à plusieurs emploi de temps
     * On défint ici une relation many-to-many
     * la relation inverse many-to-many est défini dans le modèle Vaccine.php 
     */
    public function vaccines()
    {
        return $this->belongsToMany(Vaccine::class, "vaccines_schedules_vaccines", "vaccine_schedule_id", "vaccine_id");
    }
}
