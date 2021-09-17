<?php

namespace App\Services;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;

class SearchRvService {

    public $name = null;
    public $adress = null;
    public $title = null;
    public $vaccineName = null;
    public $vaccineType = null;
    public $date = null;
    public $table;
    public $orderBy = "desc";
    public $orderColumn = null;

    public function __construct($name, $adress, $title, 
     $vaccineName, $vaccineType, $table, $date, $orderColumn)
    {
        $this->name = $name;
        $this->adress = $adress;
        $this->title = $title;
        $this->vaccineName = $vaccineName;
        $this->vaccineType = $vaccineType;
        $this->orderColumn = $orderColumn;
        $this->date = $date;
        $this->table = $table;
    }

    public function search(){
        $query = DB::table($this->table);
        // Si on reçoit les données du formuaire de prise de rv de consulation en ligne ou en présentiel
        if($this->table == "schedules"){
            $query->join("users", $this->table.'.user_id', '=', 'users.id');

            if($this->name != null){
                $query->orwhere("users.first_name", "like", "%".$this->name."%");
                $query->orwhere("users.last_name", "like", "%".$this->name."%");
            }

            if($this->adress != null){
                $query->orwhere("users.adress", "like", "%".$this->adress."%");
            }

            if($this->title != null){
                $query->orwhere("users.title", "like", "%".$this->title."%");
            }

            if($this->date != null){
               
                $query->orwhere($this->table.".schedule_date", "=", $this->date);     
            }
 

        }else{ // Sinon nous recevons les données du formulaire de prise de rv pour un vaccin
            $query->join("vaccines", $this->table.'.id', '=', 'vaccines.hospital_id'); // On lie l'hopiatal à ses vaccines
            // Maintenat il faut lier le vaccins à tous ses emploi de temps
            //Puisque il existe une relation many-to-many entre Vaccine et VaccineSchedules, il faudra passer
            // par la table intermédiare vaccines_schedules_vaccines
            // $query->select(
            //     $this->table.".id as hospitalId", 
            //     $this->table.".name as hospitalName", 
            //     $this->table.".adress as hospitalAdress",
            //     $this->table.".phone as hospitalPhone",
            //     $this->table.".user_id as hospitalUserId",
            //     "vaccines.id as vaccineId",
            //     "vaccines.name as vaccineName",
            //     "vaccines.type as vaccineType",
            //     "vaccines.total as vaccineTotal",
            //     "vaccines.hospital_id as vaccineHospitalId");
            // dd($query->get());
            $query->join("vaccines_schedules_vaccines", 'vaccines.id', '=', 'vaccines_schedules_vaccines.vaccine_id');  
            $query->join("vaccine_schedules", 'vaccines_schedules_vaccines.vaccine_schedule_id', '=', 'vaccine_schedules.id');
            // dd($query->get());

            if($this->date != null){
  
                $query->orwhere("vaccine_schedules.schedule_date", "=", $this->date);   
            }

            if($this->vaccineName != null){
                   
                $query->orwhere("vaccines.name", "like", "%".$this->name."%");
            }

            if($this->vaccineType != null){
                $query->orwhere("vaccines.type", "like", "%".$this->vaccineType."%");
            }
            if($this->name != null){
                $query->orwhere($this->table.".name", "like", "%".$this->name."%");
            }

            if($this->adress != null){
                $query->orwhere($this->table.".adress", "like", "%".$this->adress."%");
            }
    
            
        }

        // On a activé le soft delete d'ou la présence d'une colonne deleted_at sur tous nous colonne
        // Le query builder ne prends en compte les models soft-deleted comme le fait Eloquent
        // il faudra le préciser

        if($this->table == "schedules"){
            $query->where("schedules.deleted_at", "=", NULL);
        }else{
            $query->where("vaccine_schedules.deleted_at", "=", NULL);

        }

        if($this->table == "schedules"){
            $query->select(
                $this->table.".id as scheduleId", 
                $this->table.".schedule_date as scheduleDate", 
                $this->table.".start_time as scheduleStartTime",
                $this->table.".end_time as scheduleEndTime",
                "users.id as userId",
                "users.first_name as userFirstName",
                "users.last_name as userLastName",
                "users.title as userTitle",
            
            );
        }
     
        if($this->table == "hospitals"){
            $query->select(
                $this->table.".id as hospitalId", 
                $this->table.".name as hospitalName", 
                $this->table.".adress as hospitalAdress",
                $this->table.".phone as hospitalPhone",
                $this->table.".user_id as hospitalUserId",
                "vaccines.id as vaccineId",
                "vaccines.name as vaccineName",
                "vaccines.type as vaccineType",
                "vaccines.total as vaccineTotal",
                "vaccines.hospital_id as vaccineHospitalId",
                "vaccine_schedules.id as scheduleId", 
                "vaccine_schedules.schedule_date as scheduleDate", 
                "vaccine_schedules.start_time as scheduleStartTime",
                "vaccine_schedules.end_time as scheduleEndTime",
            );
        }
        // if($this->table == "hospitals"){
        //     echo "tablble = $this->table";
        //     echo "<br>";
        //     echo "name = $this->name";
        //     echo "<br>";
        //     echo "adres = $this->adress";
        //     echo "<br>";
        //     echo "nom vaccin = $this->vaccineName";
        //     echo "<br>";
        //     echo "type vaccin = $this->vaccineType";
        //     echo "<br>";
        //     echo "date = $this->date";
        //     echo "<br>";
        //     echo "oder col = $this->orderColumn";
        //     echo "<br>";
        //     echo "orderby = $this->orderBy";
        //     // dd("stop");
        // }

        if($this->orderColumn != null){
            if($this->table == "schedules"){
                switch ($this->orderColumn) {
                    case "schedule_date":
                        $query->orderBy($this->table.'.schedule_date', $this->orderBy);
                        // dd("case schedule_date");
                        break;
                    case "doctor_name":
                        $query->orderBy('users.first_name', $this->orderBy);
                        $query->orderBy('users.last_name', $this->orderBy);
                        // dd("case doctor_name");
                        break;
                    case "doctor_title":
                        $query->orderBy('users.title', $this->orderBy);
                        // dd("case doctor_title");
                        break;
                    case "doctor_adress":
                        $query->orderBy('users.adress', $this->orderBy);
                        // dd("case doctor_adress");
                        break;
                    
                    default:
                        
                        break;
                }
            }else{

                switch ($this->orderColumn) {
                    case "vaccines_schedules_date":
                        $query->orderBy('vaccines_schedules.schedule_date', $this->orderBy);
                        break;
                    case "vaccine_name":
                        $query->orderBy('vaccines.name', $this->orderBy);
                        
                        break;
                    case "vaccine_type":
                        $query->orderBy('vaccines.vaccine_type', $this->orderBy);
                        break;

                    case "hospital_name":
                        $query->orderBy('hospitals.name', $this->orderBy);
                        break;
                    
                    case "hospital_adress":
                        $query->orderBy('hospitals.adress', $this->orderBy);
                        break;
                    
                    default:
                        
                        break;
                }

            }
        }

    
        //  dd($query);
        return $query;
         
    }

    public function getData(){
        // if($this->table = "hospitals"){
        //     dd($this->search()->get());

        // }
        return $this->search()->paginate(5);
    }
    
}