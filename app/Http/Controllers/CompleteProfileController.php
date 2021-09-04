<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompleteProfileController extends Controller
{
    public function create(){
        return view("users.complete-profile");
    }
}
