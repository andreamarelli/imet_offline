<?php

use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use AndreaMarelli\ModularForms\Controllers\UploadFileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () { return Redirect::to('admin/confirm_user'); });

    // Authentication Routes
    Route::get('admin/confirm_user', [StaffController::class, 'confirm_offline_user']);
    Route::patch('admin/staff/{item}', [StaffController::class, 'update_offline']);


    Route::get('file/{hash}',      [UploadFileController::class, 'download']);

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('upload', [UploadFileController::class, 'upload']);
        Route::get('download', [UploadFileController::class, 'download']);
        Route::group(['prefix' => 'search'], function () {
            Route::post('protected_areas', [ProtectedAreaController::class, 'search']);
            Route::post('species', [SpeciesController::class, 'search']);
        });
    });

});

