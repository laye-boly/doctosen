<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

     /**
     * Get the hospitals for the doctor user.
     */
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }
}
