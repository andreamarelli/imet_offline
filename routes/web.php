<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpBasketController;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use AndreaMarelli\ModularForms\Controllers\UploadFileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', function () { return Redirect::to('confirm_user'); });

    // User routes
    Route::get('confirm_user', [UserController::class, 'confirm_offline_user']);
    Route::patch('confirm_user', [UserController::class, 'update_offline_user'])->name('update_offline_user');

    // IMET requirements - do not remove nor change
    Route::get('file/{hash}',      [UploadFileController::class, 'download']);
    Route::prefix('ajax')->group(function () {
        Route::post('upload', [UploadFileController::class, 'upload']);
        Route::get('download', [UploadFileController::class, 'download']);
    });

});

