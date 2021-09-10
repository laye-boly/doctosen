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
        // dd($ids);
        
        foreach($ids as $id){
            $medical->doctors()->attach($id);
        }
 

        $medical->save();

        $documents = $this->getUserDocuments();


        return redirect()->route('medical.index')->with(['documents', $documents]);
    }


    public function show(MedicalDocument $document){

        
        return view("medical_documents.show")->with("document", $document);
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
// dd($doctors);
            return $doctors;
    }

   

    

    
}
