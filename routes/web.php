<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointementController;
use App\Http\Controllers\MedicalDocumentController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\VaccineScheduleController;
use App\Http\Controllers\VaccineAppointementController;

use App\Models\User;
use App\Services\SearchRvService;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', function(SearchRvService $service){
//     $service->table = "hospitals";
//     // $service->name = "laye";
//     $service->name = "phil";
//     // $service->vaccine = "x";
//     dd($service->getData()->unique());
//     $users = User::paginate(2);
//     // dd($users);
//     // dd($users->items);
//     return view('test', compact("users"));
// });

Route::middleware(['auth:sanctum', 'verified', 'complete.registration'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::match(['get', 'post'], '/', [HomeController::class, "index"]
)->name("home");




Route::middleware(['auth','complete.registration'])->group(function () {

    // Route pour compléter l'inscription pour les structure sanitaire et les médecins
    Route::get('/user/profile/complete', [CompleteProfileController::class, "create"])
        ->name("complete.create")
        ->withoutMiddleware(['complete.registration']);

    // début route pour les structures sanitaire 

    Route::get('/user/hospital', [HospitalController::class, "index"])
        ->name("hospital.index");
       
    
    Route::get('/user/hospital/create', [HospitalController::class, "create"])
        ->name("hospital.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/hospital/store', [HospitalController::class, "store"])
        ->name("hospital.store")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/hospital/show/{hospital}', [HospitalController::class, "show"])
        ->name("hospital.show")
        ;

    Route::get('/user/hospital/edit/{hospital}', [HospitalController::class, "edit"])
        ->name("hospital.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/hospital/update', [HospitalController::class, "update"])
        ->name("hospital.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/hospital/delete/{hospital}', [HospitalController::class, "delete"])
        ->name("hospital.delete")
        ;
    
    // Fin route pour les structure sanitaires

    // début routes pour les diplômes

    Route::post('/user/diploma/store', [DiplomaController::class, "store"])
        ->name("diploma.store")
        ->withoutMiddleware(['complete.registration']);

     Route::get('/user/diploma/show/{diploma}', [DiplomaController::class, "show"])
        ->name("diploma.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/diploma/edit/{diploma}', [DiplomaController::class, "edit"])
        ->name("diploma.edit")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/diploma/update/{diploma}', [DiplomaController::class, "update"])
        ->name("diploma.update")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/diploma/download/{filename}', [DiplomaController::class, "download"])
        ->name("diploma.download");
    
    Route::get('/user/diploma', [DiplomaController::class, "index"])
        ->name("diploma.index");
    
    Route::get('/user/diploma/create', [DiplomaController::class, "create"])
        ->name("diploma.create");
    
    Route::post('/user/diploma/delete/{diploma}', [DiplomaController::class, "delete"])
        ->name("diploma.delete");

    // Fin routes pour les diplômes

    // début route pour les vaccins

    Route::get('/user/vaccine', [VaccineController::class, "index"])
        ->name("vaccine.index");
        
    
    Route::get('/user/vaccine/create', [VaccineController::class, "create"])
        ->name("vaccine.create");
       

    Route::post('/user/vaccine/store', [VaccineController::class, "store"])
        ->name("vaccine.store");
        

    Route::get('/user/vaccine/show/{vaccine}', [VaccineController::class, "show"])
        ->name("vaccine.show");
       

    Route::get('/user/vaccine/edit/{vaccine}', [VaccineController::class, "edit"])
        ->name("vaccine.edit");
      
    
    Route::post('/user/vaccine/update/{vaccine}', [VaccineController::class, "update"])
        ->name("vaccine.update");
       

    Route::post('/user/vaccine/delete/{vaccine}', [VaccineController::class, "delete"])
        ->name("vaccine.delete");
        
    
    // Fin route pour les vaccin

    // début route pour les emploi de temps des vaccins

    Route::get('/user/vaccine/schedule', [VaccineScheduleController::class, "index"])
        ->name("vaccine.schedule.index");
        
    
    Route::get('/user/vaccine/schedule/create', [VaccineScheduleController::class, "create"])
        ->name("vaccine.schedule.create");
        

    Route::post('/user/vaccine/schedule/store', [VaccineScheduleController::class, "store"])
        ->name("vaccine.schedule.store");
       

    Route::get('/user/vaccine/schedule/show/{vaccineSchedule}', [VaccineScheduleController::class, "show"])
        ->name("vaccine.schedule.show");

    Route::get('/user/vaccine/schedule/edit/{vaccineSchedule}', [VaccineScheduleController::class, "edit"])
        ->name("vaccine.schedule.edit");
       
    
    Route::post('/user/vaccine/schedule/update/{vaccineSchedule}', [VaccineScheduleController::class, "update"])
        ->name("vaccine.schedule.update");
     

    Route::post('/user/vaccine/schedule/delete/{vaccineSchedule}', [VaccineScheduleController::class, "delete"])
        ->name("vaccine.schedule.delete");
        
    
        // Fin routes pour les emploi de temps pour les vaccins
    
    // début route pour rendez-vous de vaccination

    Route::get('/user/vaccine/appointement', [VaccineAppointementController::class, "index"])
        ->name("vaccine.appointement.index");
       
    
    Route::get('/user/vaccine/appointement/create', [VaccineAppointementController::class, "create"])
        ->name("vaccine.appointement.create");
        

    Route::post('/user/vaccine/appointement/store', [VaccineAppointementController::class, "store"])
        ->name("vaccine.appointement.store");
       

    Route::get('/user/vaccine/appointement/show/{vaccineAppointement}', [VaccineAppointementController::class, "show"])
        ->name("vaccine.appointement.show");
       

    Route::get('/user/vaccine/appointement/edit/{vaccineAppointement}', [VaccineAppointementController::class, "edit"])
        ->name("vaccine.appointement.edit");
       
    
    Route::post('/user/vaccine/appointement/update/{vaccineAppointement}', [VaccineAppointementController::class, "update"])
        ->name("vaccine.appointement.update");
    

    Route::post('/user/vaccine/appointement/delete/{vaccineAppointement}', [VaccineAppointementController::class, "delete"])
        ->name("vaccine.appointement.delete");
        

        Route::get('/user/vaccine/appointement/download/{vaccineAppointement}', [VaccineAppointementController::class, "download"])
        ->name("vaccine.appointement.download");
       
    
        // Fin routes pour les rendez-vous de vaccination 
     

    Route::get('/dashboard/doctor/schedule/create', [ScheduleController::class, "create"])->name("schedule.create");
    Route::get('/dashboard/doctor/schedule', [ScheduleController::class, "index"])->name("schedule.index");
    Route::post('/dashboard/doctor/schedule/store', [ScheduleController::class, "store"])->name("schedule.store");
    Route::get('/dashboard/doctor/schedule/edit/{id}', [ScheduleController::class, "edit"])->name("schedule.edit");
    Route::post('/dashboard/doctor/schedule/update/{id}', [ScheduleController::class, "update"])->name("schedule.update");
    Route::post('/dashboard/doctor/schedule/delete', [ScheduleController::class, "delete"])->name("schedule.delete");

    Route::get('/dashboard/user/appointement', [AppointementController::class, "index"])->name("appointement.index");
    Route::get('/dashboard/user/appointement/create', [AppointementController::class, "create"])->name("appointement.create");
    Route::post('/dashboard/user/appointement/store', [AppointementController::class, "store"])->name("appointement.store");
    Route::get('/dashboard/user/appointement/edit/{id}', [AppointementController::class, "edit"])->name("appointement.edit");
    Route::post('/dashboard/user/appointement/update/{id}', [AppointementController::class, "update"])->name("appointement.update");
    Route::post('/dashboard/user/appointement/delete', [AppointementController::class, "delete"])->name("appointement.delete");
    Route::get('/dashboard/user/appointement/show/{id}', [AppointementController::class, "show"])->name("appointement.show");
    Route::get('/dashboard/user/appointement/download/{id}', [AppointementController::class, "download"])->name("appointement.download");

    // Début route pour document médicaux
    Route::get('/dashboard/user/medical/document', [MedicalDocumentController::class, "index"])->name("medical.index");
    Route::get('/dashboard/user/medical/document/create', [MedicalDocumentController::class, "create"])->name("medical.create");
    Route::post('/dashboard/user/medical/document/store', [MedicalDocumentController::class, "store"])->name("medical.store");
    Route::get('/dashboard/user/medical/document/edit/{medicalDocument}', [MedicalDocumentController::class, "edit"])->name("medical.edit");
    Route::post('/dashboard/user/medical/document/update/{medicalDocument}', [MedicalDocumentController::class, "update"])->name("medical.update");
    Route::get('/dashboard/user/medical/document/show/{medicalDocument}', [MedicalDocumentController::class, "show"])->name("medical.show");
    Route::get('/dashboard/user/medical/document/download/{medicalDocument}', [MedicalDocumentController::class, "download"])->name("medical.download");
    Route::match(['get', 'post'], '/dashboard/user/medical/document/upload', [MedicalDocumentController::class, "upload"])->name("medical.upload");
    Route::get('/dashboard/user/medical/document/upload/{filename}', [MedicalDocumentController::class, "downloadMedicalDocument"])->name("medical.downloadMedicalDocument");
    // Fin route pour document médicaux


  
});



