<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Diploma;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;


class DiplomaController extends Controller
{
    public function index (Request $request){

        $diplomas = Auth::user()->diplomas;
        

        return view('diplomas.index')->with([
            'diplomas' => $diplomas
            
        ]);
    }

    public function create(Request $request){
        
        $duplication = false;
        if($request->has("duplication")){
            $duplication = $request->input('duplication');
        }

        return view("diplomas.create", ['duplication' => $duplication]);
    }
    /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function store(Request $request){

        
        $this->validate($request, [
            'title' => 'required',
            'year' => array('required',
                            'regex:#^1|2\d{3}$#'
                        ),
            'image' => 'required|mimes:pdf'
        ]);

        $diplomas = Auth::user()->diplomas;
        foreach($diplomas as $diploma){
            // dd(123);
            if(strtoupper($diploma->title) == strtoupper($request->input("title")) ){
                $dulication = true;
                return redirect()->route('diploma.create', ["duplication" => $dulication]);
            }
        }

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
            // navigateur. Donc il faut cr??er un lien symbolique du dossier /public (accesible ?? notre navigateur)
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
        return redirect()->route("diploma.create")->with([
            'success-diploma' => 'Votre document a ??t?? bien uplod??'
            
            
        ]);

    }

    public function show (Diploma $diploma){

        return view("diplomas.show")->with(
            [
                'diploma' => $diploma
            ]
        );
    }
    public function edit(Request $request, Diploma $diploma){

        $duplication = false;

        if($request->has("duplication")){
            $duplication = $request->input('duplication');
        }

        return view("diplomas.edit")->with(
            [
                'diploma' => $diploma,
                'duplication' => $duplication
            ]
        );
    }

    /**

     * Get the URL to a controller action.

     *
     * @param  Request  $request
    */
    public function update(Request $request, Diploma $diploma){

      
        $this->validate($request, [
            'title' => 'required',
            'year' => array('required',
                            'regex:#^1|2\d{3}$#'
                        ),
            'image' => 'required|mimes:pdf'
        ]);

        $diplomas = Auth::user()->diplomas;
        foreach($diplomas as $diplomaFromDb){
            // dd(123);
            if((strtoupper($diplomaFromDb->title) == strtoupper($request->input("title"))) && $diploma->id != $diplomaFromDb->id ){
                $dulication = true;
                return redirect()->route('diploma.edit', ["diploma" => $diploma,"duplication" => $dulication]);
            }
        }

        if($request->hasFile('image')){


            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // On supprime l'ancien dipl??me
            Storage::disk('public')->delete('diplomas/'.$diploma->image);

            // On stocke le nouveau fichiers

            // Upload Image L'iameg est uplode dans le dossier storage/app/public qui n'est pas accesible par notre
            // navigateur. Donc il faut cr??er un lien symbolique du dossier /public (accesible ?? notre navigateur)
            // au dossier storage/app/public
            // ON le fait avec la commande php artisan storage:link
            $path = $request->file('image')->storeAs('public/diplomas', $fileNameToStore);

            

        } 


    
        $diploma->title = $request->input("title");
        $diploma->year = $request->input("year");
        $diploma->image = $fileNameToStore;

        $user = User::find(Auth::user()->id);
        $user->diplomas()->save($diploma);

        // Redirection avec des mesages flashbag dans la sessions
        return redirect()->route("diploma.edit", ["diploma" => $diploma])->with([
            'success-diploma' => 'Votre document a ??t?? bien modifi??'
            
            
        ]);

    }

    public function delete(Request $request, Diploma $diploma){
        // dd("stop");
        $this->validate($request, [
            'diploma-id' => [
                        Rule::in([$diploma->id]),
                        'required'
                    ]
        ]);

        
        // On supprime  dipl??me
        Storage::disk('public')->delete('diplomas/'.$diploma->image);
        $diploma->delete();

        // dd("ici  ici");

        return redirect()->route('diploma.index')->with([
            'succes-delete' => 'Le dipl??me a ??t?? suprim??e avec succ??s !'
        ]);
    }

    public function download($filename){

        $file = Storage::disk('public')->get('diplomas/'.$filename);

        return response ($file, 200)->header('Content-Type', 'application/pdf');
      
        
    }
}
