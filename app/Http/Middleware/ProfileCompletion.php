<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    
    {
        // dd("stop -ProfileCompletion is running  "); // Pour vérifier si ProfileCompletion est exécuté
        $user = Auth::user();

       

      
        if($user->type == "doctor" || $user->type == "hospital"){
            // dd("doc hos");
            if(count($user->hospitals->toArray()) == 0){
                return redirect("/user/profile/complete");
                dd(0);
            }

            if($user->type == "doctor" && count($user->diplomas->toArray()) == 0){
                return redirect("/user/profile/complete");
            }
        }

        return $next($request);
    }
}
