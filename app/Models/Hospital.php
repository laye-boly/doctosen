<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use HasFactory;
    use SoftDeletes;

     /**
     * Get the hospitals for the doctor user.
     */
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }
}
