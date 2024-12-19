<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Doctor\DoctorAvailabilityController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Hospital\HospitalManagementController;
use App\Http\Controllers\Insurance\InsuranceProviderController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\Guest\GuestController;



//---------------------Auth route--------------------

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);




//---------------------Superadmin route--------------------
Route::middleware(['auth', 'checkrole:SuperAdmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');

    Route::prefix('hospital')->name('hospital.')->group(function () {
        Route::get('/', [HospitalManagementController::class, 'index'])->name('index');
        Route::post('/', [HospitalManagementController::class, 'store'])->name('store');
        Route::put('/{id}', [HospitalManagementController::class, 'update'])->name('update'); // Ensure this is here
        Route::delete('/{id}', [HospitalManagementController::class, 'destroy'])->name('destroy'); // Ensure this is here
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // View all users
        Route::post('/store', [UserController::class, 'store'])->name('store'); // Add a new user
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy'); // Delete a user
    });


    Route::prefix('insurance')->group(function () {
        Route::get('/', [InsuranceProviderController::class, 'index'])->name('insurance.index');
        Route::post('/store', [InsuranceProviderController::class, 'store'])->name('insurance.store');
        Route::put('/update/{id}', [InsuranceProviderController::class, 'update'])->name('insurance.update');
        Route::delete('/delete/{id}', [InsuranceProviderController::class, 'destroy'])->name('insurance.destroy');
    });


    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/availability', [DoctorAvailabilityController::class, 'index'])->name('availability.index');
        Route::post('/availability', [DoctorAvailabilityController::class, 'store'])->name('availability.store');
        Route::put('/availability/{id}', [DoctorAvailabilityController::class, 'update'])->name('availability.update');
        Route::delete('/availability/{id}', [DoctorAvailabilityController::class, 'destroy'])->name('availability.destroy');
    });
});

// Admin Routes
Route::middleware(['auth', 'checkrole:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Doctor Routes
Route::middleware(['auth', 'checkrole:Doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
});

// Patient Routes
Route::middleware(['auth', 'checkrole:Patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');

    Route::get('appointment/doctor-availability', [App\Http\Controllers\Appointment\DoctorAvailableController::class, 'index'])
        ->name('appointment.doctor-availability.index');


    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('doctor.appointment.store');


    // Route to handle appointment booking form submission
});



//---------------------Testing View--------------------
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    // Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user.profile.updatePassword');

    Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user.profile.update.password');
});



Route::middleware(['auth'])->group(function () {



    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});



// Route::get('/', function () {
//     return view('welcome');
// });
