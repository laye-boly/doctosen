<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaccineAppointement extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Un un rv de vaccination ne peut concerner que un et un seul patient
     * Alors que un patient peut prendre un ou plusieur rv de vaccination
     * On définit une relation one-to-many (ou inversement many-to-one) entre Patient et VaccineAppointement
     */

    public function patient()
    {
        return $this->belongsTo(User::class, "patient_id");
    }

    /**
     * Un un rv de vaccination ne peut concerner que un et un seul emploi de temps de vaccination
     * Alors que pour un emploi de temps de vaccination plusieurs rv de vaccination peuvent être prises
     * On définit une relation one-to-many (ou inversement many-to-one) entre VaccineSchedule et VaccineAppointement
     */

    public function vaccineSchedule()
    {
        return $this->belongsTo(VaccineSchedule::class, "vaccine_schedule_id");
    }
}
