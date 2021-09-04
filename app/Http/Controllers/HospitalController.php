<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Hospital;

use App\Models\User;


class HospitalController extends Controller
{
     /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function store(Request $request){
        // Validation des données saisie
        $this->validate($request, [
            'name' => 'required',
            'adress' => 'required',
            'phone' => array('required',
                            'regex:#^7(7|8|0|6)|33\d{7}$#'
                )
        ]);
        $hospital = new Hospital;
        $hospital->name = $request->input("name");
        $hospital->adress = $request->input("adress");
        $hospital->phone = $request->input("phone");

        $user = User::find(Auth::user()->id);
        $user->hospitals()->save($hospital);
        // $patient->patientAppointement()->save($hospital);
        // $user = User::find(Auth::user()->id);



        // $user->doctorAppointement()->save($hospital);
        // $patient = User::find(2);
        // $patient->patientAppointement()->save($hospital);


    }

    public function create(){

    }
}
