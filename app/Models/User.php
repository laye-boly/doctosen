<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'email',
        'adress',
        'phone',
        'title',
        'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // begin - relationships defintion

    /**
     * Get the hospitals for the doctor user.
     */
    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
    /**
    * Get the hospitals for the doctor user.
     */
    public function diplomas()
    {
        return $this->hasMany(Diploma::class);
    }

    /**
    * Get the schedules for the doctor user.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

     /**
     * Get the appointments for the doctor user.
     */
    public function doctorAppointement()
    {
        return $this->hasMany(Appointement::class, "doctor_id");
    }

    /**
     * Get the appointments for the patient user.
     */
    public function patientAppointement()
    {
        return $this->hasMany(Appointement::class, "patient_id");
    }

     // end - relationships defintion

}
