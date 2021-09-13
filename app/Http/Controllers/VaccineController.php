<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vaccine;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Validation\Rule;



class VaccineController extends Controller
{
    public function index (Request $request){

        $hospital = Auth::user()->hospitals[0];

        $vaccines = $hospital->vaccines;

        return view('vaccines.index')->with([
            'vaccines' => $vaccines
        ]);
    }

    public function create(Request $request){

        return view("vaccines.create");
    }

    public function store(Request $request){
        // Validation des données saisie
        $this->validate($request, [
            'type' => 'required',
            'total' => 'required|numeric',
            'name' => 'required|unique:vaccines'
            
        ]);
        $vaccine = new Vaccine;
        $vaccine->type = $request->input("type");
        $vaccine->total = $request->input("total");
        $vaccine->name = $request->input("name");
      

        $user = User::find(Auth::user()->id);

        $hospital = $user->hospitals[0];
        $hospital->vaccines()->save($vaccine) ;    
  

       
        // Redirection avec des mesages flashbag dans la sessions
        return redirect('/user/vaccine/create')->with(['success-hospital' => 'Les informations ont été sauvegardées avec succès !']);


    }
    

    public function show (Vaccine $vaccine){

        return view("vaccines.show")->with(
            [
                'vaccine' => $vaccine
            ]
        );
    }

    public function edit(Vaccine $vaccine){

        return view("vaccines.edit")->with(
            [
                'vaccine' => $vaccine
            ]
        );
    }

    public function update(Request $request, Vaccine $vaccine){
        // Validation des données saisie
        $this->validate($request, [
            'type' => 'required',
            'total' => 'required|numeric',
            'name' => 'required'
            
        ]);

        $vaccine->type = $request->input("type");
        $vaccine->total = $request->input("total");
        $vaccine->name = $request->input("name");
  
        $user = User::find(Auth::user()->id);

        $hospital = $user->hospitals[0];
        $hospital->vaccines()->save($vaccine) ;   
      

  

       
        // Redirection avec des mesages flashbag dans la sessions
        return redirect()->route('vaccine.index')->with(['success-update' => 'Les informations ont été modifiées avec succès !']);


    }


    public function delete(Request $request, Vaccine $vaccine){
        // dd("stop");
        $this->validate($request, [
            'vaccine-id' => [
                        Rule::in([$vaccine->id]),
                        'required'
                    ]
        ]);

        $vaccine->delete();

        // dd("ici  ici");

        return redirect()->route('vaccine.index')->with([
            'success-delete' => 'Le vaccin a été suprimée avec succés !'
        ]);
    }

   
}
