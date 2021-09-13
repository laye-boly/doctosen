<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Hospital;

use App\Models\User;

use Illuminate\Validation\Rule;


class HospitalController extends Controller
{

    public function index (Request $request){

        $hospitals = Auth::user()->hospitals;

        return view('hospitals.index')->with([
            'hospitals' => $hospitals
        ]);
    }

    public function create(Request $request){

        return view("hospitals.create");
    }
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
            ),
            "uri" => array(
                'required',
                'regex:#^/user/profile/complete|/user/profile/complete/hospital/create$#'
            )
        ]);
        $hospital = new Hospital;
        $hospital->name = $request->input("name");
        $hospital->adress = $request->input("adress");
        $hospital->phone = $request->input("phone");

        $user = User::find(Auth::user()->id);
        $user->hospitals()->save($hospital);
        // On prend l'url vers laquel on doit rediriger
         $uri = $request->input('uri');

        

       
        // Redirection avec des mesages flashbag dans la sessions
        return redirect($uri)->with(['success-hospital' => 'Les informations ont été renseigné avec succès !']);


    }

    public function show(Hospital $hospital){
        return view("hospitals.show")->with(['principalHospital' => $hospital]);
    }

   
}
