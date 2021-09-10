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

      
    /**
     * Get the medicaldocuments for the doctor user
     * Le médecin peut accéder à un ou plsusieurs dossier medical
     * On défint ici une relation many-to-many car un document médical peut être partagé par plusieurs
     * médecins
     * la relation inverse many-to-many est défini dans le modèle MedicalDocument.php 
     */
    public function doctorMedicalsDocuments()
    {
        return $this->belongsToMany(MedicalDocument::class, "medical_doctor", "doctor_id", "medical_id");
    }

    /**
     * Get the medicaldocuments for the patient user.
     * On définit une realation many-to-one entre un patient et un document médical
     * Un document médical ne peut appartenir qu'a un seulpatient aors qu'un patient peut avoir plusieur
     * document médical qui constitueront son dossier médical
     * la relation inverse est défint dans MedicalDocument.php
     */
    public function patientMedicalDocument()
    {
        return $this->hasMany(MedicalDocument::class, "patient_id");
    }

     // end - relationships defintion

    public function toString(){
        return $this->first_name. " ".$this->last_name." tel :".$this->phone;
    }

}
