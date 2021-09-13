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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/', [HomeController::class, "index"]
);



Route::middleware(['auth','complete.registration'])->group(function () {

    Route::get('/user/profile/complete', [CompleteProfileController::class, "create"])
        ->name("complete.create")
        ->withoutMiddleware(['complete.registration']);

    // début route pour les structures sanitaire 

    Route::get('/user/profile/complete/hospital', [HospitalController::class, "index"])
        ->name("hospital.index")
        ->withoutMiddleware(['complete.registration']);
    
    Route::get('/user/profile/complete/hospital/create', [HospitalController::class, "create"])
        ->name("hospital.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/hospital/store', [HospitalController::class, "store"])
        ->name("hospital.store")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/profile/complete/hospital/show/{hospital}', [HospitalController::class, "show"])
        ->name("hospital.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/profile/complete/hospital/edit{hospital}', [HospitalController::class, "edit"])
        ->name("hospital.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/profile/complete/hospital/update', [HospitalController::class, "update"])
        ->name("hospital.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/hospital/delete/{hospital}', [HospitalController::class, "delete"])
        ->name("hospital.delete")
        ->withoutMiddleware(['complete.registration']);
    
    // Fin route pour les structure sanitaires

    // début routes pour les diplômes

    Route::post('/user/profile/complete/diploma/store', [DiplomaController::class, "store"])
        ->name("diploma.store")
        ->withoutMiddleware(['complete.registration']);

     Route::get('/user/profile/complete/diploma/show/{diploma}', [DiplomaController::class, "show"])
        ->name("diploma.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/profile/complete/diploma/edit/{diploma}', [DiplomaController::class, "edit"])
        ->name("diploma.edit")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/diploma/update/{diploma}', [DiplomaController::class, "update"])
        ->name("diploma.update")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/profile/complete/diploma/download/{filename}', [DiplomaController::class, "download"])
        ->name("diploma.download");
    
    Route::get('/user/profile/complete/diploma', [DiplomaController::class, "index"])
        ->name("diploma.index");
    
    Route::get('/user/profile/complete/diploma/create', [DiplomaController::class, "create"])
        ->name("diploma.create");
    
    Route::post('/user/profile/complete/diploma/delete/{diploma}', [DiplomaController::class, "delete"])
        ->name("diploma.delete");

    // Fin routes pour les diplômes

    // début route pour les vaccins

    Route::get('/user/vaccine', [VaccineController::class, "index"])
        ->name("vaccine.index")
        ->withoutMiddleware(['complete.registration']);
    
    Route::get('/user/vaccine/create', [VaccineController::class, "create"])
        ->name("vaccine.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/store', [VaccineController::class, "store"])
        ->name("vaccine.store")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/show/{vaccine}', [VaccineController::class, "show"])
        ->name("vaccine.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/edit/{vaccine}', [VaccineController::class, "edit"])
        ->name("vaccine.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/vaccine/update/{vaccine}', [VaccineController::class, "update"])
        ->name("vaccine.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/delete/{vaccine}', [VaccineController::class, "delete"])
        ->name("vaccine.delete")
        ->withoutMiddleware(['complete.registration']);
    
    // Fin route pour les vaccin

    // début route pour les emploi de temps des vaccins

    Route::get('/user/vaccine/schedule', [VaccineScheduleController::class, "index"])
        ->name("vaccine.schedule.index")
        ->withoutMiddleware(['complete.registration']);
    
    Route::get('/user/vaccine/schedule/create', [VaccineScheduleController::class, "create"])
        ->name("vaccine.schedule.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/schedule/store', [VaccineScheduleController::class, "store"])
        ->name("vaccine.schedule.store")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/schedule/show/{vaccineSchedule}', [VaccineScheduleController::class, "show"])
        ->name("vaccine.schedule.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/schedule/edit/{vaccineSchedule}', [VaccineScheduleController::class, "edit"])
        ->name("vaccine.schedule.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/vaccine/schedule/update/{vaccineSchedule}', [VaccineScheduleController::class, "update"])
        ->name("vaccine.schedule.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/schedule/delete/{vaccineSchedule}', [VaccineScheduleController::class, "delete"])
        ->name("vaccine.schedule.delete")
        ->withoutMiddleware(['complete.registration']);
    
        // Fin routes pour les emploi de temps pour les vaccins
    
    // début route pour rendez-vous de vaccination

    Route::get('/user/vaccine/appointement', [VaccineAppointementController::class, "index"])
        ->name("vaccine.appointement.index")
        ->withoutMiddleware(['complete.registration']);
    
    Route::get('/user/vaccine/appointement/create', [VaccineAppointementController::class, "create"])
        ->name("vaccine.appointement.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/appointement/store', [VaccineAppointementController::class, "store"])
        ->name("vaccine.appointement.store")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/appointement/show/{vaccineAppointement}', [VaccineAppointementController::class, "show"])
        ->name("vaccine.appointement.show")
        ->withoutMiddleware(['complete.registration']);

    Route::get('/user/vaccine/appointement/edit/{vaccineAppointement}', [VaccineAppointementController::class, "edit"])
        ->name("vaccine.appointement.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/vaccine/appointement/update/{vaccineAppointement}', [VaccineAppointementController::class, "update"])
        ->name("vaccine.appointement.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/vaccine/appointement/delete/{vaccineAppointement}', [VaccineAppointementController::class, "delete"])
        ->name("vaccine.appointement.delete")
        ->withoutMiddleware(['complete.registration']);
    
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


    Route::get('/dashboard/user/medical/document', [MedicalDocumentController::class, "index"])->name("medical.index");
    Route::get('/dashboard/user/medical/document/create', [MedicalDocumentController::class, "create"])->name("medical.create");
    Route::post('/dashboard/user/medical/document/store', [MedicalDocumentController::class, "store"])->name("medical.store");
    Route::get('/dashboard/user/medical/document/edit/{id}', [MedicalDocumentController::class, "edit"])->name("medical.edit");
    Route::post('/dashboard/user/medical/document/update/{id}', [MedicalDocumentController::class, "update"])->name("medical.update");
    Route::get('/dashboard/user/medical/document/show/{document}', [MedicalDocumentController::class, "show"])->name("medical.show");
    Route::get('/dashboard/user/medical/document/download/{document}', [MedicalDocumentController::class, "download"])->name("medical.download");
    Route::match(['get', 'post'], '/dashboard/user/medical/document/upload', [MedicalDocumentController::class, "upload"])->name("medical.upload");
    Route::get('/dashboard/user/medical/document/upload/{filename}', [MedicalDocumentController::class, "downloadMedicalDocument"])->name("medical.downloadMedicalDocument");


  
});



