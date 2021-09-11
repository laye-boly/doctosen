<?php
    namespace App\Http\Controllers;

    use App\Models\Appointement;
    use Illuminate\Http\Request;

    use App\Models\MedicalDocument;

    use Illuminate\Support\Facades\Auth;

    use App\Models\User;

    use Faker\Provider\Medical;

    use Illuminate\Validation\Rule;

    use Illuminate\Support\Facades\DB;

    use App\Models\MedicalDoctor;

    use Illuminate\Support\Facades\App;

    use Illuminate\Support\Facades\Storage;

    class MedicalDocumentController extends Controller

    {
        public function index(Request $request){

            
            $documents = $this->getUserDocuments();

            // dd($documents->patient);

            return view("medical_documents.index")->with("documents", $documents);
        }

        public function create(Request $request){
            
        
            $doctorPatientsId = $this->getDoctorPatientId();
            $doctorPatients = User::all()->whereIn("id", $doctorPatientsId)->all();

            $doctorPatientsArray = [];
            foreach($doctorPatients as $doctorPatient){
                $doctorPatientsArray[$doctorPatient->id] = "$doctorPatient->first_name $doctorPatient->last_name";
            }
        
            // dd($doctorPatientsArray);
        
            return view("medical_documents.create")->with(["doctorPatients" => $doctorPatientsArray]);
        }


        public function store(Request $request){

            $doctorPatientsId = $this->getDoctorPatientId();

            $this->validate($request, [
                'body' => array(
                    "required"
                ), 
                // "type" => "regex:#^certificat médical|ordonnance|recommandation|autre$#",
                "patient" => Rule::in($doctorPatientsId)
            ]);
            // "regex:#^confirmé|en attente de confirmation|fait|annulé$#"
            $medical = new MedicalDocument();
            $medical->body = $request->input("body");
            $medical->type = $request->input("type");
            $medical->author_id = Auth::user()->id;
            $medical->upload = 0;
            $medical->document_medical_date  = new \DateTime();

            $patient = User::find($request->input("patient"));
            $doctor = User::find(Auth::user()->id);

            
            $patient->patientMedicalDocument()->save($medical);

            // En laravel, tout juste apres l'insersion d'un model, on accés à l'id de la base de donnée par
            // model->id

            $medicalId = $medical->id;

            $doctor->doctorMedicalsDocuments()->attach($medicalId);

            
            $documents = $this->getUserDocuments();

    //    dd($documents);
            return redirect()->route('medical.index');
        }

        public function edit(Request $request, $id){
            
        
            $medical = MedicalDocument::findOrFail($id);
            
            $doctorMedicals = $this->findDoctorForDocument($medical);

            $doctorMedicalIds = [];

            foreach($doctorMedicals as $doctor){
                $doctorMedicalIds[] = $doctor->id;
            }
            // Seuls les medecins qui n'ont pas  accès au document médical seront sur le select multiple
            $doctorsInital = User::where("type", "doctor")->get()->whereNotIn("id", $doctorMedicalIds)->all();
            // dd($doctorsInital);

            // On construit le tableau qui servira aux select multiple pour donner acces à un ou plusieurs médecins
            // au document médical
            $doctors = [];
            foreach($doctorsInital as $doctor){
                $doctors[$doctor->id] = $doctor->toString();
            }

        return view("medical_documents.edit")->with([
            "medical" => $medical, 
            "doctorMedicals" => $doctorMedicals,
            "doctors" => $doctors
        ]);
        


        }

        public function update(Request $request, $id){

            $medical = MedicalDocument::findOrFail($id);

            $this->validate($request, [
                'body' => array(
                    "required"
                )
            
                // "type" => "regex:#^certificat médical|ordonnance|recommandation|autre$#",
            
            ]);
            // "regex:#^confirmé|en attente de confirmation|fait|annulé$#"
        
            $medical->body = $request->input("body");
            $medical->type = $request->input("type");

            // On récupère les id des médecins auquels on a donné accés au document médical du patient
            // et on verifi que ce n'est vide
            $newIdDoctors = $request->input("doctors");
            
            // On récupére les médecins qui avaient déja accés au documents

            $alreadyDoctorsAcces = $this->findDoctorForDocument($medical);
            // On récupère les id des médecins qui avaient déja accés au documents
            $alreadyDoctorsAccesIds = [];

            foreach($alreadyDoctorsAcces as $doctor){
                $alreadyDoctorsAccesIds[] = $doctor->id;
            }

            // si $newIdDoctors n'est pas vide on le fusionne avec les id des medcin qui ont déja acces au 
            //  document médical
            $ids = $alreadyDoctorsAccesIds;
            if(count($newIdDoctors) != 0){
                $ids = array_merge($alreadyDoctorsAccesIds, $newIdDoctors);
            }

            // On lie le document au medecins 
            foreach($ids as $id){
                $medical->doctors()->attach($id);
            }
    

            $medical->save();

            $documents = $this->getUserDocuments();


            return redirect()->route('medical.index')->with(['documents', $documents]);
        }


        public function show(MedicalDocument $document){

            //On récupère le médecin qui a établit l'ordonnance
            $author = User::find($document->author_id);
            // On récupère la structure sanitaire principal du médecin auteur de l'ordonnance
            $principalHospital = $author->hospitals[0];

            // On prend tous les medecins qui ont accés au document médical
            $doctors = $this->findDoctorForDocument($document);

        //   dd($doctors);
            return view("medical_documents.show")->with([
                "document" => $document, 
                "author" => $author,
                "principalHospital" => $principalHospital,
                "doctors" => $doctors
            ]);
        }

        public function download(Request $request, MedicalDocument $document){

     
            
            //On récupère le médecin qui a établit l'ordonnance
            $author = User::find($document->author_id);
            // On récupère la structure sanitaire principal du médecin auteur de l'ordonnance
            $principalHospital = $author->hospitals[0];
    
            // On prend tous les medecins qui ont accés au document médical
            $doctors = $this->findDoctorForDocument($document);

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('medical_documents.download', [
                "document" => $document, 
                "author" => $author,
                "principalHospital" => $principalHospital,
                "doctors" => $doctors
            ]);
            return $pdf->download($document->type.'.pdf');
        }



        public function upload(Request $request){

            // On prend le verbe  HTTP de la requete
            $method = $request->method();
            $user = User::find(Auth::user()->id);
            $authorType = $user->type;
            $cibles = null;
            $destinataires = [];
       
            if($authorType == "doctor"){
                // nous prenons tous les patients du médecins
                $cibles = DB::table('users')
                    ->join('appointements', 'users.id', '=', 'appointements.patient_id')
                    ->select('users.*')
                    ->where("appointements.doctor_id", "=", $user->id)
                    ->get()
                    ->unique()// On élimine les duplication;
                    ->all(); 
                    
            }else{
                // nous prenons tous les médecin  du patients
                $cibles = DB::table('users')
                    ->join('appointements', 'users.id', '=', 'appointements.doctor_id')
                    ->select('users.*')
                    ->where("appointements.patient_id", "=", $user->id)
                    ->get()
                    ->unique()// On élimine les duplication;
                    ->all(); 
                    
            }
          
            // On construit le tableau qui servira aux select  pour donner acces à un ou plusieurs médecins
            // au document médical ou attribuer le document medical à un patient
            
            foreach($cibles as $cible){
                $destinataires[$cible->id] = $this->itemUserCollectionToString($cible) ;
            }
            if ($request->isMethod('get')) {
                
                return view("medical_documents.upload")->with([
                    "authorType" => $authorType,
                    "destinataires" => $destinataires,
                    
                ]);

            }else{
               
                if($request->input("hidden_input") == "doctor"){

                    $doctorPatientsId = $this->getDoctorPatientId();

                    // Validation des données saisie
                    $this->validate($request, [
                        'type' => 'required',
                        'file' => 'required|mimes:pdf',
                        "destinataire" => Rule::in($doctorPatientsId)
                    ]);

                }else if($request->input("hidden_input") == "patient"){

                    $patientDoctorId = $this->getPatienDoctortId();

                    // Validation des données saisie
                    $this->validate($request, [
                        'type' => 'required',
                        'file' => 'required|mimes:pdf',
                        "destinataire" => Rule::in($patientDoctorId)
                    ]);

                }else{
                    return "formuaire incorrect";
                }

            // On commence à enregistrer le fichier uploder

            // On récupère le nom du fichier avec l'extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // On prend le nom du fichier
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // On prend l'extension du fichier
            $extension = $request->file('file')->getClientOriginalExtension();
            // On génère le nom sous lequel le fichier sera stocké
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            /** 
                * Upload Image Le fichier est uplode dans le dossier storage/app/public qui n'est pas accesible par notre
                 * navigateur. Donc il faut créer un lien symbolique du dossier /public (accesible à notre navigateur)
                * au dossier storage/app/public
                * ON le fait avec la commande php artisan storage:link 
            */
            $path = $request->file('file')->storeAs('public/documents_medical', $fileNameToStore);

            

            // On lie le fichier stocké à notre medicalDocument model

            $document = new MedicalDocument();
            $document->body = $fileNameToStore;
            $document->type = $request->input("type");
            $document->author_id = Auth::user()->id;
            $document->upload = 1;
            $document->document_medical_date = new \DateTime();
            
            // Dans la suite on attache le document à d'auttes modél, on doit l'enregistrer au préalable

            $document->save();

            // Si cest le médecin qui upload le document, on lie le document au patient qu'il a choisi au niveau 
            // du formulaire
            if($authorType == "doctor"){
       
                // Puisque c'est un médecin qui uplodé le document il y a accés automatiquement
                $document->doctors()->attach($user->id);

                // Un document médical est toujours associé à un patient. 
                // On récupère le patient choisi par le médecin au niveau du formulaire
                $patient = User::find($request->input("destinataire"));

                $patient->patientMedicalDocument()->save($document);

                return redirect('/dashboard/user/medical/document/upload')->with([
                    'success' => 'Votre document a été bien uplodé',
                    'id'      => $document->id
                ]);
            }else{

                
                // Si c'est un patient qui upload le document , on lie le document à lui-meme d'abord et
                // Ensuite lie le document au médecins qui doivent accéder au document

                $patient = User::find(Auth::user()->id);
                $patient->patientMedicalDocument()->save($document);


                //On récupère tous les medecins qu'il a 
                //choisi au niveau du formulaire
            
                $doctorIds = $request->input("destinataire");

                // On lie le document au medecins
                foreach($doctorIds as $id){
                    $document->doctors()->attach($id);
                }
    
                // On enregistre le document médical
                $document->save();
                return redirect('/dashboard/user/medical/document/upload')->with([
                    'success' => 'Votre document a été bien uplodé',
                    'id'      => $document->id
                ]);

            }

            

        

            }


        }

        public function downloadMedicalDocument($filename){

            $file = Storage::disk('public')->get('documents_medical/'.$filename);
  
            return response ($file, 200)->header('Content-Type', 'application/pdf');
          
            
        }


        private function getDoctorPatientId(){

            $appointements = Appointement::all();

            // On ne prendra que les patients de notre medecin
            $doctoraAppointements = $appointements->reject(function ($appointement) {
                // on rejecte tous les rv dont le doctor_id est diffrent de l'id du medecin connecté 
                return $appointement->doctor_id != Auth::user()->id;
            });
        
            $doctorPatientsId = [];
            foreach($doctoraAppointements as $doctoraAppointement){
                $doctorPatientsId[] = $doctoraAppointement->patient_id;
            }

            $doctorPatientsId = collect($doctorPatientsId)->unique()->toArray();

            return $doctorPatientsId;
        }

        private function getPatienDoctortId(){

            $appointements = Appointement::all();

            // On ne prendra que les médecin  de notre patients
            $patientAppointements = $appointements->reject(function ($appointement) {
                // on rejecte tous les rv dont le doctor_id est diffrent de l'id du medecin connecté 
                return $appointement->doctor_id != Auth::user()->id;
            });
        
            $patientDoctorsId = [];
            foreach($patientAppointements as $patientAppointement){
                $patientDoctorsId[] = $patientAppointement->patient_id;
            }

            $patientDoctorsId = collect($patientDoctorsId)->unique()->toArray();

            

            return $patientDoctorsId;
        }

        private function getUserDocuments(){

            $documents = null;
            $user = User::find(Auth::user()->id);
            if($user->type == "doctor"){


                $medicalIdsRelatedToDoctor = [];
                foreach ($user->doctorMedicalsDocuments as $doctorMedicalsDocument) {
                    
                    $medicalIdsRelatedToDoctor[] =  $doctorMedicalsDocument->pivot->medical_id;
                }

                // dd($medicalIdsRelatedToDoctor);
                $medicalIdsRelatedToDoctor = collect($medicalIdsRelatedToDoctor)->unique()->toArray();

                $documents = MedicalDocument::all()->whereIn("id", $medicalIdsRelatedToDoctor)->all();
                

            
            }else{
                $documents = MedicalDocument::where("patient_id", Auth::user()->id)->orderBy('id', 'DESC')->get();
            }

            return $documents;
        }


        private function findDoctorForDocument($document){


            $doctorIds = [];
            $medicalDoctors =  MedicalDoctor::where("medical_id", $document->id)->get();
        
                foreach ($medicalDoctors as $doctor) {
                    
                    $doctorIds[] =  $doctor->doctor_id;
                }
                $doctorIds = collect($doctorIds)->unique()->toArray();

                $doctors = User::all()->whereIn("id", $doctorIds)->all();
   
                return $doctors;
        }

        private function itemUserCollectionToString($item){

            return $item->first_name. " ".$item->last_name." tel :".$item->phone;
        }

    

        

        
    }
