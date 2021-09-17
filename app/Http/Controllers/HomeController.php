<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\SearchRvService;
use Illuminate\Http\Request;


class HomeController extends Controller {

    public function index(Request $request, SearchRvService $searchRvService){

        // $schedules = Schedule::all();
        $searchRvService->table = "schedules";
        $consultationsSchedules= $searchRvService->getData();

        $searchRvService->table = "hospitals";
        $vaccinesSchedules= $searchRvService->getData();
        if(count($request->all()) > 1){
            
            $table = $request->input("table_name");
            // dd($table);
            $searchRvService->table = $table;
            if($request->input("adress") != null){
                $searchRvService->adress = $request->input("adress");

            }
            if($request->input("date") != null){
                $searchRvService->date = $request->input("date");

            }
            if($request->input("order_column") != null){
                $searchRvService->orderColumn = $request->input("order_column");

            }
            if($request->input("order_by") != null){
                $searchRvService->orderBy = $request->input("order_by");

            }

            if($request->input("name") != null){
                $searchRvService->name = $request->input("name");

            }
            if($table == "schedules"){
               
                if($request->input("title") != null){
                    $searchRvService->title = $request->input("title");  
                }
                $consultationsSchedules = $searchRvService->getData();
            }else {

                if($request->input("vaccine_name") != null){
                    $searchRvService->vaccineName = $request->input("vaccine_name");
                    $searchRvService->vaccineType = $request->input("vaccine_type");        
                }
                $vaccinesSchedules = $searchRvService->getData();

            }

        }

        // dd($vaccinesSchedules);

        return view("home")->with([
            "consultationsSchedules" => $consultationsSchedules,
            "vaccinesSchedules" => $vaccinesSchedules
        ]);
    }
}