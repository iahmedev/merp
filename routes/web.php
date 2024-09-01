<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\EmploymentInfoController;
use App\Http\Controllers\NextOfKinController;
use App\Livewire\ListDepartments;
use App\Livewire\ListDesignations;
use App\Livewire\ListEmploymentStatuses;
use App\Livewire\ListEmploymentTypes;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
    });

    Route::controller(UserDetailController::class)->group(function () {
        Route::get('/userDetail/{userDetail}/edit', 'edit')->name('userDetail.edit');
        Route::patch('/userDetail/{userDetail}', 'update')->name('userDetail.update');
        Route::get('/userDetail/create/{user}', 'create')->name('userDetail.create');
        Route::post('/userDetail', 'store')->name('userDetail.store');
    });

    Route::controller(EmploymentInfoController::class)->group(function () {
        Route::get('/employmentInfo/{employmentInfo}/edit', 'edit')->name('employmentInfo.edit');
        Route::patch('/employmentInfo/{employmentInfo}', 'update')->name('employmentInfo.update');
        Route::get('/employmentInfo/create/{user}', 'create')->name('employmentInfo.create');
        Route::post('/employmentInfo', 'store')->name('employmentInfo.store');
    });

    Route::controller(NextOfKinController::class)->group(function () {
        Route::get('/nextOfKin/{nextOfKin}/edit', 'edit')->name('nextOfKin.edit');
        Route::patch('/nextOfKin/{nextOfKin}', 'update')->name('nextOfKin.update');
        Route::get('/nextOfKin/create/{user}', 'create')->name('nextOfKin.create');
        Route::post('/nextOfKin', 'store')->name('nextOfKin.store');
    });

    Route::get('departments', ListDepartments::class)->name('departments');
    Route::get('designations', ListDesignations::class)->name('designations');
    Route::get('employmentType', ListEmploymentTypes::class)->name('employmentType');
    Route::get('employmentStatus', ListEmploymentStatuses::class)->name('employmentStatus');
});

require __DIR__ . '/auth.php';
