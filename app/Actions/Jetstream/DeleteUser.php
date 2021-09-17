<?php

namespace App\Actions\Jetstream;


use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        
        // On supprime les hopitaux, les vaccins, les rv de vaccination et finalement l'hôpital
        $hospitals = $user->hospitals;
        if(count($hospitals) > 0){
            foreach ($hospitals as $hospital) {
                $vaccines = $hospital->vaccines;
                if(count($vaccines) > 0){
                   foreach($vaccines as $vaccine){
                       $schedules = $vaccine->schedules;
                       if(count($schedules) > 0){
                            foreach ($schedules as $schedule) {
                                $appointements = $schedule->vaccineAppointement;
                                if(count($appointements) > 0){
                                    foreach ($appointements as $appointement) {
                                        $appointement->delete();
                                    }
                                }

                                $schedule->delete();
                            }
                       }

                       $vaccine->delete();
                       
                   }
                }

                $hospital->delete();
            }
        }
        // dd($hospitals);
        
      

        $appointements = [];

        if($user->type == "doctor"){
            $appointements = $user->doctorAppointement;
        }else if($user->type == "pateint"){
            $appointements = $user->patientAppointement;

        }

        if(count($appointements) > 0){

            foreach ($appointements as $appointement) {
                $appointement->delete();
            }
        }
        // dd($appointements);

        if($user->type == "doctor"){
            $schedules = $user->schedules;
            if(count($schedules) > 0){
                foreach ($schedules as $schedule) {
                    $schedule->delete();
                }
            }

            // dd($schedules);
        }

        if($user->type == "doctor"){
            $diplomas = $user->diplomas;
            if(count($diplomas) > 0){
                foreach ($diplomas as $diploma) {
                    $diploma->delete();
                }
            }

            // dd($diplomas);
        }
     

        $medicalDocuments = [];

        if($user->type == "doctor"){
            $medicalDocuments = $user->doctorMedicalsDocuments;
        }else if($user->type == "patient"){
            $medicalDocuments = $user->patientMedicalDocument;

        }

        // dd($medicalDocuments);

        if(count($medicalDocuments) > 0){
            foreach ($medicalDocuments as $medicalDocument) {
                $medicalDocument->delete();
            }
        }

        if($user->type == "patient"){
            $patientVaccineAppointements = $user->patientVaccineAppointement;
            if(count($patientVaccineAppointements) > 0){
                foreach ($patientVaccineAppointements as $patientVaccineAppointement) {
                    $patientVaccineAppointement->delete();
                }
            }

            // dd($patientVaccineAppointements);
        }

       

        // dd("stop");
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        
        $user->delete();
    }
}
