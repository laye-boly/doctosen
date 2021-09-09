<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointementController;

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

Route::get('/user/profile/complete', [CompleteProfileController::class, "create"]
);

Route::post('/user/profile/complete/hospital', [HospitalController::class, "store"]
);

Route::post('/user/profile/complete/diploma', [DiplomaController::class, "store"]
);





Route::middleware(['auth'])->group(function () {

    Route::get('/user/profile/complete', [CompleteProfileController::class, "create"]
    );

    Route::post('/user/profile/complete/hospital', [HospitalController::class, "store"]
    );

    Route::post('/user/profile/complete/diploma', [DiplomaController::class, "store"]
    );

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
});