<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VaccineAppointement;

use App\Models\VaccineSchedule;

use App\Models\User;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VaccineAppointementController extends Controller
{
    public function index(Request $request){
        $appointements = [];
        $user = Auth::user();
       
        if($user->type == "hospital"){
            //On prend la structure sanitaire
            $hospital = $user->hospitals[0];
            // On prend tous ses vaccins
            $vaccines = $hospital->vaccines;

            $schedules = []; // le tableau qui va contenir les emploi de temps
            // Pour chaque vaccin, on prends ses emploi des temps
            foreach($vaccines as $vaccine){
                $vaccineSchedules = $vaccine->schedules ;

                // Pour chaque emploi de temps on récupère ses rendez-vous
                // Puisque nous somme en presnce d'une relation many-to-many entre Vaccine et VaccineSchedule
                // On le fait a travers la tables intermédire representé par l'attribut pivot des relations
                foreach($vaccineSchedules as $vaccineSchedule){

                    
                    // On récupères les rendez-vous liée au emploi de temps
                    $appointementsIntermediates = $vaccineSchedule->vaccineAppointement;
                    
                    // On ajoute chaque  rendez-vous au  tableau  de rv

                    foreach($appointementsIntermediates as $appointement){
                        $appointements[] = $appointement;
                    }
                    
                }
                
            }
           

        
            $appointements = collect($appointements)->sortDesc();
        }else{
            $appointements = VaccineAppointement::where("patient_id", Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
        
        

        return view("vaccine_appointements.index")->with("appointements", $appointements);
    }


    public function create(Request $request){
        // C'est à partir de la liste des emploi de temps que l'on proprose aux patients de prendre Rv
        // en cliquant sur le bouton prendre rv. Ce bouton pointe vers cette methode.
        // On prend le soin d'ajouter à la requete l'id de l'emploi de temps de la vaccination
        // et l'id du patient qui prend rv
        //La methodé store qui va valider le formulaire s'en servira pour faire la liaison



        $scheduleId = $request->input("schedule_id");
        $patientId = $request->input("patient_id");

        $errorTime = "no";

        if($request->has("errorTime")){
            $errorTime = $request->input("errorTime");
            
        }

      
        return view("vaccine_appointements.create")->with(["schedule_id" => $scheduleId, "patient_id" => $patientId, "errorTime" => $errorTime]);
    }

    /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function store(Request $request){
        // dd("je sui ec");
        // Validation des données saisie
        $this->validate($request, [
            'appointement_hour' => array(
                                        'required',
                                        'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
                                )

        ]);

        $appointement = new VaccineAppointement();
        $appointement->status = "en attente de confirmation";
        $appointementHour = $request->input("appointement_hour");
        $appointement->appointement_hour = $appointementHour;
        
        
        $schedule = VaccineSchedule::findOrFail($request->input("schedule_id"));
      
        
        $patient = User::findOrFail($request->input("patient_id"));
        

        $appointement->appointement_date = $schedule->schedule_date;
        // On récupère les heures de début et de fin de l'emploi du de la vaccination
        $starTime =  $schedule->start_time;
        $endTime = $schedule->end_time;
        // On convertis les heures de disponibilité du docteur en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $starTimeTotimestamp = strtotime($starTime);
        $endTimeTotimestamp = strtotime($endTime);

        // On convertis l'heure choisis par le patient en timestamp unix
        $appointementHourTotimestamp = strtotime($appointementHour);


        // On s'assure que l'heure du patient est compris dans l'intervalle de de vaccination
        if($appointementHourTotimestamp >= $starTimeTotimestamp && $appointementHourTotimestamp <= $endTimeTotimestamp){
           
            $appointement->save();
            $patient->patientVaccineAppointement()->save($appointement);
            $schedule->vaccineAppointement()->save($appointement);

            return redirect()->route('vaccine.appointement.index');

        }else{
                $errorTime = "Veuillez choisir une heure comprise entre $starTime et $endTime";
            
            return redirect()->route('vaccine.appointement.create', ["schedule_id" => $schedule->id, "patient_id" => $patient->id, "errorTime" => $errorTime]);
        }



    }

    public function show(Request $request, VaccineAppointement $vaccineAppointement){
        $patient = $vaccineAppointement->patient;
        $vaccineAppointement = DB::table("vaccine_appointements")
             ->join("vaccine_schedules", 'vaccine_appointements.vaccine_schedule_id', '=', 'vaccine_schedules.id')
             ->join("vaccines_schedules_vaccines", "vaccines_schedules_vaccines.vaccine_schedule_id", "=", "vaccine_schedules.id")
             ->join("vaccines", "vaccines_schedules_vaccines.vaccine_id", "=", "vaccines.id")
             ->join("hospitals", "hospitals.id", "=", "vaccines.hospital_id")
             ->where("vaccine_appointements.patient_id", "=", $patient->id)
             ->select(
                 "vaccine_appointements.id as appointementId",
                 "vaccine_appointements.appointement_date as appointement_date",
                 "vaccine_appointements.appointement_hour as appointement_hour",
                 "vaccine_appointements.status as status",
                 "vaccine_appointements.vaccine_schedule_id as scheduleId",
                 "vaccines.type as vaccineType",
                 "vaccines.name as vaccineName",
                 "vaccines.total as vaccineTotal",
                 "hospitals.name as hospitalName",
                 "hospitals.adress as hospitalAdress",
                 "hospitals.phone as hospitalPhone"
                 )
             ->get();
             
     //    dd($vaccineAppointement);
 
             
         return view("vaccine_appointements.show")->with([
             "appointement" => $vaccineAppointement,
             "patient" => $patient
         ]);
     }

    public function update(Request $request, $id){
        $this->validate($request, [
            'status' => array("required",
            "regex:#^confirmé|en attente de confirmation|fait|annulé$#")
        ]);

        $appointement = VaccineAppointement::findOrFail($id);
        $appointement->status = $request->input("status");
        $appointement->save();

        
        return redirect()->route('vaccine.appointement.show', ["vaccineAppointement" => $appointement]);

    }

    

    public function download(Request $request, VaccineAppointement $vaccineAppointement){
        $patient = $vaccineAppointement->patient;
        // dd($patient);
        $appointement = DB::table("vaccine_appointements")
             ->join("vaccine_schedules", 'vaccine_appointements.vaccine_schedule_id', '=', 'vaccine_schedules.id')
             ->join("vaccines_schedules_vaccines", "vaccines_schedules_vaccines.vaccine_schedule_id", "=", "vaccine_schedules.id")
             ->join("vaccines", "vaccines_schedules_vaccines.vaccine_id", "=", "vaccines.id")
             ->join("hospitals", "hospitals.id", "=", "vaccines.hospital_id")
             ->where("vaccine_appointements.patient_id", "=", $patient->id)
             ->select(
                 "vaccine_appointements.id as appointementId",
                 "vaccine_appointements.appointement_date as appointement_date",
                 "vaccine_appointements.appointement_hour as appointement_hour",
                 "vaccine_appointements.status as status",
                 "vaccine_appointements.vaccine_schedule_id as scheduleId",
                 "vaccine_appointements.patient_id as PatientId",
                 "vaccines.type as vaccineType",
                 "vaccines.name as vaccineName",
                 "vaccines.total as vaccineTotal",
                 "hospitals.name as hospitalName",
                 "hospitals.adress as hospitalAdress",
                 "hospitals.phone as hospitalPhone"
                 )
             ->get();

             
  
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('vaccine_appointements.download', compact('patient', 'appointement'));
        return $pdf->download('rendez_vous_vaccination.pdf');

        // ok ok
    }
}
