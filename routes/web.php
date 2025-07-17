<?php

use App\Http\Controllers\backend\admin\DashboardController;
use App\Http\Controllers\backend\admin\DivisionController;
use App\Http\Controllers\backend\admin\LearnerController;
use App\Http\Controllers\backend\admin\ProfileController;
use App\Http\Controllers\backend\admin\ZillaController;
use App\Http\Controllers\backend\AuthenticationController;
use App\Http\Controllers\backend\operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\backend\operator\ImportantLinkController;
use App\Http\Controllers\backend\operator\ProfileController as OperatorProfileController;
use App\Http\Controllers\FrontEndController;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\OperatorAuthenticationMiddleware;
use Illuminate\Support\Facades\Route;

// frontend 

Route::get('/', [FrontEndController::class, 'home'])->name('home');


// backend 
Route::match(['get', 'post'], 'login', [AuthenticationController::class, 'login'])->name('login');
// route prefix 
Route::prefix('admin')->group(function () {
    // route name prefix 
    Route::name('admin.')->group(function () {
        //middleware 
        Route::middleware(AdminAuthenticationMiddleware::class)->group(function () {
            Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
            //profile 
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
            Route::post('profile-info/update', [ProfileController::class, 'profile_info_update'])->name('profile.info.update');
            Route::post('profile-password/update', [ProfileController::class, 'profile_password_update'])->name('profile.password.update');
            //dashboard
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

            Route::match(['get', 'post'], 'division', [DivisionController::class, 'division'])->name('division');

            Route::get('division/delete/{id}', [DivisionController::class, 'division_delete'])->name('division.delete');

            Route::match(['get', 'post'], 'zilla', [ZillaController::class, 'Zilla'])->name('zilla');

            Route::get('zilla/delete/{id}', [ZillaController::class, 'delete'])->name('zilla.delete');

            Route::match(['get', 'post'], 'link/add', [ImportantLinkController::class, 'important_link_add'])->name('link.add');

            Route::match(['get', 'post'], 'learner/add', [LearnerController::class, 'learner_add'])->name('learner.add');

            Route::get('learner/list', [LearnerController::class, 'learner_list'])->name('learner.list');

            Route::get('/learner/pdf', [LearnerController::class, 'downloadPdf'])->name('learner.pdf');

            Route::match(['get', 'post'], 'learner/edit/{id}', [LearnerController::class, 'learner_edit'])->name('learner.edit');

            Route::get('learner/delete/{id}', [LearnerController::class, 'learner_delete'])->name('learner.delete');
        });
    });
});
// Advocate 
// route prefix
Route::prefix('operator')->group(function () {
    // route name prefix
    Route::name('operator.')->group(function () {
        //middleware 
        Route::middleware(OperatorAuthenticationMiddleware::class)->group(function () {
            Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
            //profile 
            Route::get('profile', [OperatorProfileController::class, 'profile'])->name('profile');
            Route::post('profile-info/update', [OperatorProfileController::class, 'profile_info_update'])->name('profile.info.update');
            Route::post('profile-password/update', [OperatorProfileController::class, 'profile_password_update'])->name('profile.password.update');
            //dashboard 
            Route::get('dashboard', [OperatorDashboardController::class, 'dashboard'])->name('dashboard');
        });
    });
});
