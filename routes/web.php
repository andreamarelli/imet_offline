<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpBasketController;
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

    // Scaling Up Analysis
    Route::group(['prefix' => 'admin/imet/scaling_up'], function () {

        Route::get('/',      [Controller::class, 'scaling_up']);
        Route::get('download/{scaling_id}', [ScalingUpAnalysisController::class, 'download_zip_file'])->name('download_scaling_up_files');
        Route::post('analysis',     [ScalingUpAnalysisController::class, 'get_ajax_responses']);
        Route::any('/{items}',    [ScalingUpAnalysisController::class, 'report_scaling_up'])->name('report_scaling_up');
        Route::get('preview/{id}',[ScalingUpAnalysisController::class, 'preview_template'])->name('scaling_up_preview');


        Route::group(['prefix' => 'basket'], function () {
            Route::post('add',   [ScalingUpBasketController::class, 'save']);
            Route::post('get',   [ScalingUpBasketController::class, 'retrieve']);
            Route::post('all',   [ScalingUpBasketController::class, 'all']);
            Route::delete('delete/{id}',[ScalingUpBasketController::class, 'delete']);
            Route::post('clear', [ScalingUpBasketController::class, 'clear']);
        });

    });

});

