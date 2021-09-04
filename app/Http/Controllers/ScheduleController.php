<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function index(Request $request){
        $schedules = Schedule::where('user_id', Auth::user()->id)->get();
        // $schedules = DB::table('schedules')->where('user_id', '=', Auth::user()->id);

        return view('schedules.index')->with(["schedules" => $schedules]);
    }
    /**
     * Display the form of a schedule
     */

    public function create(Request $request){
        $errorTime = "no";
        $errorDate = "no";
        return view('schedules.create')->with(["errorTime" => $errorTime, "errorDate" => $errorDate]);
    }

    /**
     * Display the form of a schedule
     */

    public function store(Request $request){

        $this->validate($request, [
            'scheduleDate' => 'required',
            'startTime' =>  array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
                            ),
            'endTime'   => array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
            ),

            'consultationDuration'  => 'required'
        ]);
        $starTime =  $request->input('startTime');
        $endTime = $request->input('endTime');
        // On convertis les heures de disponibilité en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $starTimeTotimestamp = strtotime($starTime);
        $endTimeTotimestamp = strtotime($endTime);
        // On s'assure que le lheure de début de diponibilité est inférieure à celle de fin de disponibilité
        if($starTimeTotimestamp > $endTimeTotimestamp){
            $errorTime = "L'heure de début de disponiblité doit être inférieure à celle de fin de disponibilité";
            return view("schedules.create")->with(["errorTime" => $errorTime, "errorDate" => "no"]);
        }

        $scheduleDate = $request->input('scheduleDate');
        // On convertis  la date renseigné par le doctor en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $scheduleDateTotimestamp = strtotime($scheduleDate);
        // On récupère le timestamp de la date actuel
        $actualDate = new \DateTime();
        $actualDateTotimestamp = $actualDate->getTimestamp();
        // On s'assure que le date de diponibilité est inférieure à celle d'aujourd'hui
        if($scheduleDateTotimestamp < $actualDateTotimestamp){
            $errorDate = "Vous ne pouvez pas être disponiblité à une date passée";
            return view("schedule.create")->with(["errorDate" => $errorDate, "errorTime" => "no"]);
        }

        $schedule = new Schedule;
        $schedule->schedule_date = $scheduleDate;
        $schedule->start_time = $starTime;
        $schedule->end_time = $endTime;
        $schedule->consultation_duration = $request->input('consultationDuration');
        $schedule->status = 1;

        $user = User::find(Auth::user()->id);
        // On lie le le docteur à son emploi de temps et on enregistre le tout
        $user->schedules()->save($schedule);
    }

    public function edit(Request $request, $id){
        $errorTime = "no";
        $errorDate = "no";
        $schedule = Schedule::findOrFail($id);
        return view('schedules.edit')->with(["errorTime" => $errorTime, "errorDate" => $errorDate, "schedule" => $schedule]);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'scheduleDate' => 'required',
            'startTime' =>  array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
                            ),
            'endTime'   => array(
                                'required',
                                'regex:#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#'
            ),

            'consultationDuration'  => 'required'
        ]);
        $starTime =  $request->input('startTime');
        $endTime = $request->input('endTime');
        // On convertis les heures de disponibilité en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $starTimeTotimestamp = strtotime($starTime);
        $endTimeTotimestamp = strtotime($endTime);
        // On s'assure que le lheure de début de diponibilité est inférieure à celle de fin de disponibilité
        if($starTimeTotimestamp > $endTimeTotimestamp){
            $errorTime = "L'heure de début de disponiblité doit être inférieure à celle de fin de disponibilité";
            $schedule = Schedule::findOrFail($id);
            return view("schedules.edit")->with(["errorTime" => $errorTime, "errorDate" => "no", "schedule" => $schedule]);
        }

        $scheduleDate = $request->input('scheduleDate');
        // On convertis  la date renseigné par le doctor en timestamp unix (le nbre de secondes depuis le 1 janvier 1970 00:00:00 UTC)
        $scheduleDateTotimestamp = strtotime($scheduleDate);
        // On récupère le timestamp de la date actuel
        $actualDate = new \DateTime();
        $actualDateTotimestamp = $actualDate->getTimestamp();
        // On s'assure que le date de diponibilité est inférieure à celle d'aujourd'hui
        if($scheduleDateTotimestamp < $actualDateTotimestamp){
            $errorDate = "Vous ne pouvez pas être disponiblité à une date passée";
            return view("schedules.edit")->with(["errorDate" => $errorDate, "errorTime" => "no", "schedule" => Schedule::findOrFail($id)]);
        }

        $schedule = Schedule::findOrFail($id);
        $schedule->schedule_date = $scheduleDate;
        $schedule->start_time = $starTime;
        $schedule->end_time = $endTime;
        $schedule->consultation_duration = $request->input('consultationDuration');
        $schedule->status = 1;

        $user = User::find(Auth::user()->id);
        // On lie le le docteur à son emploi de temps et on enregistre le tout
        $user->schedules()->save($schedule);

        return redirect()->action([ScheduleController::class, 'index']);

    }


    public function delete(Request $request){
        $this->validate($request, [
            "schedule_id" => array('required',
                            'regex:#^[1-9]+$#')
        ]);
        $schedule = Schedule::findOrFail($request->input("schedule_id"));

        $schedule->delete();

        // return redirect("/dashboard/doctor/schedule");

        return redirect()->action([ScheduleController::class, 'index']);

    }
}
