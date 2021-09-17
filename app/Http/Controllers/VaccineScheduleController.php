<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VaccineSchedule;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;



class VaccineScheduleController extends Controller
{
    public function index(Request $request){

        //  $schedules est un tableau de tableau
        $schedules = $this->getUserHospitalVaccinesSchedules();

    //   dd($schedules);

        return view("vaccine_schedules.index")->with("schedules", $schedules);
    }

    public function create(Request $request){
        
        $hospitals = Auth::user()->hospitals;
        $vaccines =  [];
        foreach($hospitals as $hospital){
            foreach($hospital->vaccines as $vaccine){
                $vaccines[] = $vaccine;
            }
        }
        
        $vaccineArray = [];
        foreach($vaccines as $vaccine){

            $vaccineArray[$vaccine->id] = "- type du vaccin : ".$vaccine->type." - nom : ".$vaccine->name." - total : ".$vaccine->total;
        }
        $errorTime = "no";
        $errorDate = "no";
    
        if($request->has('errorTime')){
            $errorTime = $request->input("errorTime");
        }

        if($request->has('errorDate')){
            $errorDate = $request->input("errorDate");
        }
    
        return view("vaccine_schedules.create")->with(
            [
                "vaccines" => $vaccineArray,
                "errorTime" => $errorTime,
                "errorDate" => $errorDate
            ]);
    }


    public function store(Request $request){

        // On prends de la base de données tous les vaccins de notre structure sanitaire
        $vaccinesId = $this->getHospitalVaccineId();

        // dd($vaccinesId);

        // dd($request->input("vaccines"));

        $this->validate($request, [
            'scheduleDate' => array(
                "required",
                "date"
            ), 
            
            "vaccines.*" => Rule::in($vaccinesId), //
            'startTime' =>  array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
            ),
            'endTime'   => array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
            )
        ]);

        
        

        $starTime =  $request->input('startTime');
        $endTime = $request->input('endTime');
        // On convertis les heures de disponibilité en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $starTimeTotimestamp = strtotime($starTime);
        $endTimeTotimestamp = strtotime($endTime);
        // On s'assure que le lheure de début de diponibilité est inférieure à celle de fin de disponibilité
        if($starTimeTotimestamp > $endTimeTotimestamp){
            $errorTime = "L'heure de début de disponiblité doit être inférieure à celle de fin de disponibilité";
            // return view("schedules.create")->with(["errorTime" => $errorTime, "errorDate" => "no"]);
            return redirect()->route('vaccine.schedule.create', ["errorTime" => $errorTime, "errorDate" => "no"]);
        }

        

        $scheduleDate = $request->input('scheduleDate');
        // On convertis  la date renseigné par l'hopital en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $scheduleDateTotimestamp = strtotime($scheduleDate);
        // On récupère le timestamp de la date actuel
        $actualDate = new \DateTime();
        $actualDateTotimestamp = $actualDate->getTimestamp();
        // On s'assure que le date de diponibilité est inférieure à celle d'aujourd'hui
        if($scheduleDateTotimestamp < $actualDateTotimestamp){
            $errorDate = "Vous ne pouvez pas être disponiblité à une date passée";
            // return view("schedule.create")->with(["errorDate" => $errorDate, "errorTime" => "no"]);
            return redirect()->route('vaccine.schedule.create', ["errorTime" => "no", "errorDate" => $errorDate]);

        }


        $vaccineSchedule = new VaccineSchedule;
        $vaccineSchedule->schedule_date = $scheduleDate;
        $vaccineSchedule->start_time = $starTime;
        $vaccineSchedule->end_time = $endTime;
        $vaccineSchedule->status = 1;

        $vaccineSchedule->save();
        // On récupère les id des vaccins qui doivent être lié au l'emploi du temps
        // et on verifi que ce n'est vide

        $newIdvaccinesId = $request->input("vaccines");
        // On lie le le schedule aux vaccins 
        foreach($newIdvaccinesId as $id){

            $vaccineSchedule->vaccines()->attach($id);
        }

      


        $vaccineSchedule->save();

       

        return redirect()->route('vaccine.schedule.index');
    }

    public function show(VaccineSchedule $vaccineSchedule){
      
        
        return view("vaccine_schedules.show")->with(["vaccineSchedule" => $vaccineSchedule]);
    }

    public function edit(Request $request, VaccineSchedule $vaccineSchedule){

        
        $hospitals = Auth::user()->hospitals;
        $vaccines =  [];
        foreach($hospitals as $hospital){
            foreach($hospital->vaccines as $vaccine){
                $vaccines[] = $vaccine;
            }
        }

        
        
        $vaccineArray = [];
        foreach($vaccines as $vaccine){

            $vaccineArray[$vaccine->id] = "- type du vaccin : ".$vaccine->type." - nom : ".$vaccine->name." - total : ".$vaccine->total;
        }

        $errorTime = "no";
        $errorDate = "no";
    
        if($request->has('errorTime')){
            $errorTime = $request->input("errorTime");
        }

        if($request->has('errorDate')){
            $errorDate = $request->input("errorDate");
        }

        return view("vaccine_schedules.edit")->with([
            "vaccines" => $vaccineArray,
            "vaccineSchedule" => $vaccineSchedule,
            "errorTime" => $errorTime,
            "errorDate" => $errorDate
         
        ]);
    


    }

    public function update(Request $request, VaccineSchedule $vaccineSchedule){

       // On prends de la base de données tous les vaccins de notre structure sanitaire
       $vaccinesId = $this->getHospitalVaccineId();

       $this->validate($request, [
           'schedule_date' => array(
               "required",
               "date"
           ), 
           
           "vaccines" => Rule::in($vaccinesId),
           'startTime' =>  array(
                               'required',
                               'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
           ),
           'endTime'   => array(
                               'required',
                               'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
           )
       ]);

       $starTime =  $request->input('startTime');
       $endTime = $request->input('endTime');
       // On convertis les heures de disponibilité en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
       $starTimeTotimestamp = strtotime($starTime);
       $endTimeTotimestamp = strtotime($endTime);
       // On s'assure que le lheure de début de diponibilité est inférieure à celle de fin de disponibilité
       if($starTimeTotimestamp > $endTimeTotimestamp){
           $errorTime = "L'heure de début de disponiblité doit être inférieure à celle de fin de disponibilité";
           // return view("schedules.create")->with(["errorTime" => $errorTime, "errorDate" => "no"]);
           return redirect()->route('vaccine.schedule.create', ["errorTime" => $errorTime, "errorDate" => "no"]);
       }

       $scheduleDate = $request->input('scheduleDate');
       // On convertis  la date renseigné par l'hopital en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
       $scheduleDateTotimestamp = strtotime($scheduleDate);
       // On récupère le timestamp de la date actuel
       $actualDate = new \DateTime();
       $actualDateTotimestamp = $actualDate->getTimestamp();
       // On s'assure que le date de diponibilité est inférieure à celle d'aujourd'hui
       if($scheduleDateTotimestamp < $actualDateTotimestamp){
           $errorDate = "Vous ne pouvez pas être disponiblité à une date passée";
           // return view("schedule.create")->with(["errorDate" => $errorDate, "errorTime" => "no"]);
           return redirect()->route('vaccine.schedule.create', ["errorTime" => "no", "errorDate" => $errorDate]);

       }
       
      
       $vaccineSchedule->schedule_date = $scheduleDate;
       $vaccineSchedule->start_time = $starTime;
       $vaccineSchedule->end_time = $endTime;
       $vaccineSchedule->status = 1;
       // On récupère les id des vaccins qui doivent être lié au l'emploi du temps
       // et on verifi que ce n'est vide
       $newIdvaccinesId = $request->input("vaccines");
       // On lie le le schedule aux vaccins 
    
       $vaccineSchedule->vaccines()->sync($newIdvaccinesId);
       

       $vaccineSchedule->save();

      
 
    //   dd($doctors);
        return view("vaccine_schedules.show")->with([
            "vaccineSchedule" => $vaccineSchedule
           
        ]);
    }

    public function delete(Request $request, VaccineSchedule $vaccineSchedule){
       
        $this->validate($request, [
            'schedule-id' => [
                        Rule::in([$vaccineSchedule->id]),
                        'required'
                    ]
        ]);

        $vaccineSchedule->delete();



        return redirect()->route('vaccine.schedule.index')->with([
            'success-delete' => 'Le vaccin a été suprimée avec succés !'
        ]);
    }

  

   
    // remplace getDoctorPatientId
    // Quand on cree un emploi de temps pour un hopital, on ne veut apparaitre sur la liste déroulante
    // que la liste des vaccins pour cette hopital. 
    // Cette fonction nous permettra de faire un filtre

    private function getHospitalVaccineId(){

        $hospitals = Auth::user()->hospitals;
        $vaccines =  [];
        foreach($hospitals as $hospital){
            foreach($hospital->vaccines as $vaccine){
                $vaccines[] = $vaccine;
            }
        }
        $hospitalVaccinesId = [];

        foreach($vaccines as $vaccine){
            $hospitalVaccinesId[] = $vaccine->id;
        }

        return $hospitalVaccinesId;
    }

    // private function getPatienDoctortId(){

    //     $appointements = Appointement::all();

    //     // On ne prendra que les médecin  de notre patients
    //     $patientAppointements = $appointements->reject(function ($appointement) {
    //         // on rejecte tous les rv dont le doctor_id est diffrent de l'id du medecin connecté 
    //         return $appointement->doctor_id != Auth::user()->id;
    //     });
    
    //     $patientDoctorsId = [];
    //     foreach($patientAppointements as $patientAppointement){
    //         $patientDoctorsId[] = $patientAppointement->patient_id;
    //     }

    //     $patientDoctorsId = collect($patientDoctorsId)->unique()->toArray();

        

    //     return $patientDoctorsId;
    // }

    // remplace getUserDocuments

    // Retourne les emploi de temps des vaccins d'un hopital

    private function getUserHospitalVaccinesSchedules(){

        $vaccinesSchedules = DB::table("vaccine_schedules")
             ->join("vaccines_schedules_vaccines", "vaccines_schedules_vaccines.vaccine_schedule_id", "=", "vaccine_schedules.id")
             ->join("vaccines", "vaccines_schedules_vaccines.vaccine_id", "=", "vaccines.id")
             ->join("hospitals", "hospitals.id", "=", "vaccines.hospital_id")
             ->where("hospitals.user_id", "=", Auth::user()->id)
             ->where("vaccine_schedules.deleted_at", "=", NULL)
             ->select(
                 "vaccine_schedules.id as id",
                 "vaccine_schedules.schedule_date as schedule_date",
                 "vaccine_schedules.start_time as start_time",
                 "vaccine_schedules.end_time as end_time",
              
                 )
                ->orderBy("vaccine_schedules.schedule_date", "desc")
             ->get();


             return $vaccinesSchedules;
    }


    // private function findDoctorForDocument($document){


    //     $doctorIds = [];
    //     $medicalDoctors =  MedicalDoctor::where("medical_id", $document->id)->get();
    
    //         foreach ($medicalDoctors as $doctor) {
                
    //             $doctorIds[] =  $doctor->doctor_id;
    //         }
    //         $doctorIds = collect($doctorIds)->unique()->toArray();

    //         $doctors = User::all()->whereIn("id", $doctorIds)->all();

    //         return $doctors;
    // }

    // private function itemUserCollectionToString($item){

    //     return $item->first_name. " ".$item->last_name." tel :".$item->phone;
    // }



    

}
