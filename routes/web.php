<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointementController;
use App\Http\Controllers\MedicalDocumentController;






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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



Route::get('/', [HomeController::class, "index"]
);



Route::middleware(['auth','complete.registration'])->group(function () {

    Route::get('/user/profile/complete', [CompleteProfileController::class, "create"])
        ->name("complete.create")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/hospital/store', [HospitalController::class, "store"])
        ->name("hospital.store")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/hospital/show', [HospitalController::class, "show"])
        ->name("hospital.show")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/hospital/edit', [HospitalController::class, "edit"])
        ->name("hospital.edit")
        ->withoutMiddleware(['complete.registration']);
    
    Route::post('/user/profile/complete/hospital/update', [HospitalController::class, "update"])
        ->name("hospital.update")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/diploma/store', [DiplomaController::class, "store"])
        ->name("diploma.store")
        ->withoutMiddleware(['complete.registration']);

     Route::post('/user/profile/complete/diploma/show', [DiplomaController::class, "show"])
        ->name("diploma.show")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/diploma/edit', [DiplomaController::class, "edit"])
        ->name("diploma.edit")
        ->withoutMiddleware(['complete.registration']);

    Route::post('/user/profile/complete/diploma/update', [DiplomaController::class, "update"])
        ->name("diploma.update")
        ->withoutMiddleware(['complete.registration']);

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



