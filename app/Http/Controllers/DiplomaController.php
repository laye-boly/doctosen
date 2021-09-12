<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Diploma;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class DiplomaController extends Controller
{
    /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function store(Request $request){

        // var_dump("41");
        // var_dump($request->all());
        // die();
        // Validation des données saisie
        $this->validate($request, [
            'title' => 'required',
            'year' => array('required',
                            'regex:#^1|2\d{3}$#'
                        ),
            'image' => 'required|mimes:pdf'
        ]);

        if($request->hasFile('image')){


            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image L'iameg est uplode dans le dossier storage/app/public qui n'est pas accesible par notre
            // navigateur. Donc il faut créer un lien symbolique du dossier /public (accesible à notre navigateur)
            // au dossier storage/app/public
            // ON le fait avec la commande php artisan storage:link
            $path = $request->file('image')->storeAs('public/diplomas', $fileNameToStore);

            // make thumbnails
            // $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            // //$thumb = Image::make($request->file('cover_image')->getRealPath());
            // $thumb->resize(80, 80);
            // $thumb->save('storage/cover_images/'.$thumbStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $diploma = new Diploma;
        $diploma->title = $request->input("title");
        $diploma->year = $request->input("year");
        $diploma->image = $fileNameToStore;

        $user = User::find(Auth::user()->id);
        $user->diplomas()->save($diploma);

        // Redirection avec des mesages flashbag dans la sessions
        return redirect('/user/profile/complete')->with([
            'success-diploma' => 'Votre document a été bien uplodé'
            
            
        ]);

    }
}
