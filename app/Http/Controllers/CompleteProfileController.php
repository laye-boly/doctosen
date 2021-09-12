<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class CompleteProfileController extends Controller
{
    public function create(){

        $user = Auth::user();
       
        $hospitals = $user->hospitals;
        $diplomas = $user->diplomas;

       
        return view("users.complete-profile")->with([
            'hospitals' => $hospitals,
            'diplomas' => $diplomas
        ]);
    }
}
