<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointement;

use App\Models\Schedule;

use App\Models\User;

use Illuminate\Support\Facades\App;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;


class AppointementController extends Controller
{

    public function index(Request $request){
        $appointement = null;
        if(Auth::user()->type == "doctor"){
            $appointements = Appointement::where("doctor_id", Auth::user()->id)->orderBy('id', 'DESC')->get();
        }else{
            $appointements = Appointement::where("patient_id", Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
        

        return view("appointements.index")->with("appointements", $appointements);
    }


    public function create(Request $request){
        // Pour les besoins des champs cachés dans le formulaire qui sera crée
        $schedule = $request->input("schedule");
        $doctor = $request->input("doctor");
        $errorTime = $request->input("errorTime");

        // dd($errorTime);
        // On défint les erreur relatis au choix de l'heure à "no"
        // $errorTime = "no";
        return view("appointements.create")->with(["schedule" => $schedule, "doctor" => $doctor, "errorTime" => $errorTime]);
    }

    /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function store(Request $request){
        // Validation des données saisie
        $this->validate($request, [
            'appointement_hour' => array(
                                        'required',
                                        'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
                                )

        ]);

        $appointement = new Appointement();
        $appointement->status = "en attente de confirmation";
        $appointementHour = $request->input("appointement_hour");
        $appointement->appointement_hour = $appointementHour;
        $schedule = Schedule::findOrFail($request->input("schedule"));
        $doctor = User::findOrFail($request->input("doctor"));
        $appointement->appointement_date = $schedule->schedule_date;
        $starTime =  $schedule->start_time;
        $endTime = $schedule->end_time;
        // On convertis les heures de disponibilité du docteur en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $starTimeTotimestamp = strtotime($starTime);
        $endTimeTotimestamp = strtotime($endTime);

        // On convertis l'heure choisis par le patient en timestamp unix
        $appointementHourTotimestamp = strtotime($appointementHour);



        // On s'assure que l'heure du patient est compris dans l'intervalle de disponibilité du doctor
        if($appointementHourTotimestamp >= $starTimeTotimestamp && $appointementHourTotimestamp <= $endTimeTotimestamp){
            $appointementReason = $request->input("appointement_reason");

            if($appointementReason != NULL){
                $appointement->appointement_reason = $request->input("appointement_reason");

            }
            // $patient = User::find(Auth::user()->id);
            $patient = User::find(2);
            $patient->patientAppointement()->save($appointement);
            $doctor->doctorAppointement()->save($appointement);
            return redirect()->route('appointement.index');

        }else{
                $errorTime = "Veuillez choisir une heure comprise entre $starTime et $endTime";
            // return view("appointements.create")->with(["schedule" => $schedule->id, "doctor" => $doctor->id, "errorTime" => $errorTime]);
            return redirect()->route('appointement.create', ["schedule" => $schedule->id, "doctor" => $doctor->id, "errorTime" => $errorTime]);
        }



    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'status' => array("required",
            "regex:#^confirmé|en attente de confirmation|fait|annulé$#")
        ]);

        $appointement = Appointement::findOrFail($id);
        $appointement->status = $request->input("status");
        $appointement->save();

        // return redirect()->action([AppointementController::class, 'show']);
        return redirect()->route('appointement.show', [$appointement]);

    }

    public function show(Request $request, $id){
        $appointement = Appointement::findOrFail($id);
        return view("appointements.show")->with("appointement", $appointement);
    }

    public function download(Request $request, $id){
        $appointement = Appointement::findOrFail($id);
        // $pdf = PDF::loadView('appointements.download', $appointement);
        // return $pdf->download('rendez_vous.pdf');

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('appointements.download', compact('appointement'));
        return $pdf->download('rendez_vous.pdf');
    }
}
