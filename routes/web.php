<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Doctor\DoctorAvailabilityController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\DoctorReportController;
use App\Http\Controllers\Hospital\HospitalManagementController;
use App\Http\Controllers\Insurance\InsuranceProviderController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Client\ClientHospitalController;

//---------------------Auth route--------------------


Route::get('/', function () {
    return view('client.index');
});


// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);



// forget password

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');



//---------------------Superadmin route--------------------
Route::middleware(['auth', 'checkrole:SuperAdmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');

    Route::prefix('hospital')->name('hospital.')->group(function () {
        Route::get('/', [HospitalManagementController::class, 'index'])->name('index');
        Route::post('/', [HospitalManagementController::class, 'store'])->name('store');
        Route::put('/{id}', [HospitalManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [HospitalManagementController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
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



    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });
});


// Admin Routes
Route::middleware(['auth', 'checkrole:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



// Doctor Routes
Route::middleware(['auth', 'checkrole:Doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');

    Route::post('/doctor/appointments/update-status', [DoctorController::class, 'updateStatus'])->name('doctor.appointments.updateStatus');

    Route::get('/order-statistics', [DoctorController::class, 'getOrderStatistics'])->name('order.statistics');

    Route::get('/doctor/report', [DoctorReportController::class, 'index'])->name('doctor.report');

    Route::get('/doctor/invoice/{id}', [DoctorReportController::class, 'invoice'])->name('doctor.invoice');

    Route::get('/doctor/report/{id?}', [DoctorReportController::class, 'index'])->name('doctor.report');
});




// Patient Routes
Route::middleware(['auth', 'checkrole:Patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');

    Route::get('appointment/doctor-availability', [App\Http\Controllers\Appointment\DoctorAvailableController::class, 'index'])
        ->name('appointment.doctor-availability.index');

    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('doctor.appointment.store');

    Route::prefix('client/hospitals')->name('client.hospitals.')->group(function () {
        Route::get('/', [ClientHospitalController::class, 'index'])->name('index');
        Route::post('/search', [ClientHospitalController::class, 'search'])->name('search');

        // Fix the show route
        Route::get('/{id}', [ClientHospitalController::class, 'show'])->name('show');
    });
});




//---------------------Testing View--------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user.profile.update.password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});



// Route::get('/', function () {
//     return view('auth.login');
// });