<?php

namespace App\Http\Controllers;

use App\Models\Appointement;
use Illuminate\Http\Request;

use App\Models\MedicalDocument;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Faker\Provider\Medical;
use Illuminate\Validation\Rule;


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
        
        $doctorMedical = $this->findDoctorForDocument($medical);
        $doctors = User::where("type", "doctor");

    return view("medical_documents.edit")->with([
        "medical" => $medical, 
        "doctorMedical" => $doctorMedical,
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

        $medical->save();

        $documents = $this->getUserDocuments();


        return redirect()->route('medical.index')->with(['documents', $documents]);
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
            $medicalIdsRelatedToDoctor = collect($medicalIdsRelatedToDoctor)->unique()->toArray();

            $documents = MedicalDocument::all()->whereIn("id", $medicalIdsRelatedToDoctor)->all();
            

           
        }else{
            $documents = MedicalDocument::where("patient_id", Auth::user()->id)->orderBy('id', 'DESC')->get();
        }

        return $documents;
    }


    private function findDoctorForDocument(MedicalDocument $document){

       


            $doctorIdsRelatedToMedical = [];
            foreach ($document->doctors as $doctor) {
                
                $doctorIdsRelatedToMedical[] =  $doctor->pivot->doctor_id;
            }
            $doctorIdsRelatedToMedical = collect($doctorIdsRelatedToMedical)->unique()->toArray();

            $doctors = MedicalDocument::all()->whereIn("id", $doctorIdsRelatedToMedical)->all();
            

       
        return $doctors;
    }

    

    
}
