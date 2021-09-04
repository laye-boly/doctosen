<?php
namespace App\Http\Controllers;

use App\Models\Schedule;

class HomeController extends Controller {

    public function index(){

        $schedules = Schedule::all();
        return view("home")->with(["schedules" => $schedules]);
    }
}