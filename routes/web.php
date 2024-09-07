<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\EmploymentInfoController;
use App\Http\Controllers\NextOfKinController;
use App\Livewire\CreateApprovalRequest;
use App\Livewire\ListApprovalRequests;
use App\Livewire\ListDepartments;
use App\Livewire\ListDesignations;
use App\Livewire\ListEmploymentStatuses;
use App\Livewire\ListEmploymentTypes;
use App\Livewire\SingleApprovalRequest;
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
        Route::get('/user-detail/{userDetail}/edit', 'edit')->name('userDetail.edit');
        Route::patch('/user-detail/{userDetail}', 'update')->name('userDetail.update');
        Route::get('/user-detail/create/{user}', 'create')->name('userDetail.create');
        Route::post('/user-detail', 'store')->name('userDetail.store');
    });

    Route::controller(EmploymentInfoController::class)->group(function () {
        Route::get('/employment-info/{employmentInfo}/edit', 'edit')->name('employmentInfo.edit');
        Route::patch('/employment-info/{employmentInfo}', 'update')->name('employmentInfo.update');
        Route::get('/employment-info/create/{user}', 'create')->name('employmentInfo.create');
        Route::post('/employment-info', 'store')->name('employmentInfo.store');
    });

    Route::controller(NextOfKinController::class)->group(function () {
        Route::get('/next-of-kin/{nextOfKin}/edit', 'edit')->name('nextOfKin.edit');
        Route::patch('/next-of-kin/{nextOfKin}', 'update')->name('nextOfKin.update');
        Route::get('/next-of-kin/create/{user}', 'create')->name('nextOfKin.create');
        Route::post('/next-of-kin', 'store')->name('nextOfKin.store');
    });

    Route::get('departments', ListDepartments::class)->name('departments');
    Route::get('designations', ListDesignations::class)->name('designations');
    Route::get('employment-type', ListEmploymentTypes::class)->name('employmentType');
    Route::get('employment-status', ListEmploymentStatuses::class)->name('employmentStatus');

    Route::get('create-request', CreateApprovalRequest::class)->name('createApprovalRequest');
    Route::get('my-approval-requests', ListApprovalRequests::class)->name('myApprovalRequests');
    Route::get('all-approval-requests', ListApprovalRequests::class)->name('allApprovalRequests');
    Route::get('approval-request/{approvalRequest}', SingleApprovalRequest::class)->name('singleApprovalRequest');
    Route::get('assigned-request', ListApprovalRequests::class)->name('assignedRequests');

    Route::controller(ApprovalController::class)->group(function () {
        Route::post('reject-request/{approvalRequest}', 'reject')->name('approval.reject');
        Route::post('forward-request/{approvalRequest}', 'forward')->name('approval.forward');
        Route::post('approve-request/{approvalRequest}', 'approve')->name('approval.approve');
        Route::post('correction-request/{approvalRequest}', 'correction')->name('approval.correction');
        Route::post('resubmit-request/{approvalRequest}', 'resubmit')->name('approval.resubmit');
    });
});

require __DIR__ . '/auth.php';
