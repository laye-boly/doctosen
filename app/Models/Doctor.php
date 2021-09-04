<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends User
{
    use HasFactory;

   

    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    /**
     * définit la relation one-to-many entre user et diploma
     * Get the diplomas for the blog user.
     */
    public function diplomas()
    {
        return $this->hasMany(Diploma::class);
    }

    /**
     *  définit la relation one-to-many entre user et schedule
     * Get the schedules for the blog post.
     */
    public function schedules()
    {
        return $this->hasMany(schedule::class);
    }
}
