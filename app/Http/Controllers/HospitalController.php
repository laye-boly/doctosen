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
       
        // Redirection avec des mesages flashbag dans la sessions
        return redirect('/user/profile/complete')->with(['success-hospital' => 'Les informations ont été renseigné avec succès !']);


    }

    public function create(){

    }
}
