<?php

use App\Http\Controllers;
use App\Http\Controllers\Imet;


Route::group(['middleware' => 'setLocale'], function () {

    if (App::environment('imetoffline')) {

        Route::get('file/{hash}',      [Controllers\UploadFileController::class, 'download']);

        Route::get('/', function () { return view('admin.imet.offline.welcome');});
        Route::get('welcome', function () { return view('admin.imet.offline.welcome'); });
        Route::get('admin', function () { return view('admin.imet.offline.welcome'); });
        Route::get('admin/imet/offline/close', function () { return view('admin.imet.offline.close'); });
        Route::get('admin/confirm_user', function () { return view('admin.imet.offline.confirm_user'); });
        Route::get('admin/offline_user', function () { return view('admin.imet.offline.edit_user'); });
        Route::patch('admin/staff/{item}', [Controllers\StaffController::class, 'update_offline']);

        Route::group(['prefix' => 'ajax'], function () {
            Route::post('upload', [Controllers\UploadFileController::class, 'upload']);
            Route::get('download', [Controllers\UploadFileController::class, 'download']);
            Route::post('protected_areas/getLabels', [Controllers\ProtectedAreaController::class, 'getLabels']);
            Route::group(['prefix' => 'search'], function () {
                Route::post('species', [Controllers\SpeciesController::class, 'search']);
                Route::post('protected_areas', [Controllers\ProtectedAreaController::class, 'search']);
            });
        });
    }

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'imet'], function () {

            // ####  common routes (v1 & v2) ####
            Route::match(['get', 'post'],'/',      [Imet\ImetController::class, 'index']);
            Route::match(['get', 'post'],'v1',      [Imet\ImetController::class, 'index']);     // temporary alias
            Route::match(['get', 'post'],'v2',      [Imet\ImetController::class, 'index']);     // temporary alias
            Route::delete('{item}', [Imet\ImetController::class, 'destroy']);
            Route::get('{item}/export', [Imet\ImetController::class, 'export']);
            Route::get('import',        [Imet\ImetController::class, 'import_view']);
            Route::post('import',      [Imet\ImetController::class, 'import']);
            Route::get('{item}/merge',  [Imet\ImetController::class, 'merge_view']);
            Route::post('merge',      [Imet\ImetController::class, 'merge']);
            Route::post('{item}/upgrade',      [Imet\ImetController::class, 'upgrade']);

            // #### IMET Version 1 ####
            Route::group(['prefix' => 'v1'], function () {
                Route::group(['prefix' => 'context'], function () {
                    Route::get('{item}/edit/{step?}', [Imet\ImetControllerV1::class, 'edit']);
                    Route::patch('{item}',           [Imet\ImetControllerV1::class, 'update']);
                });
                Route::group(['prefix' => 'evaluation'], function () {
                    Route::get('{item}/edit/{step?}', [Imet\ImetEvalControllerV1::class, 'edit']);
                    Route::patch('{item}',           [Imet\ImetEvalControllerV1::class, 'update']);
                });
            });

            // #### IMET Version 2 ####
            Route::group(['prefix' => 'v2'], function () {
                Route::get('{item}/print',       [Imet\ImetControllerV2::class, 'print']);

                Route::group(['prefix' => 'context'], function () {
                    Route::get('{item}/edit/{step?}',[Imet\ImetControllerV2::class, 'edit']);
                    Route::get('{item}/show/{step?}',[Imet\ImetControllerV2::class, 'show']);
                    Route::patch('{item}',           [Imet\ImetControllerV2::class, 'update']);
                    Route::get('create',            [Imet\ImetControllerV2::class, 'create']);
                    Route::post('store',            [Imet\ImetControllerV2::class, 'store']);
                    Route::post('prev_years',            [Imet\ImetControllerV2::class, 'retrieve_prev_years']);
                });
                Route::group(['prefix' => 'evaluation'], function () {
                    Route::get('{item}/edit/{step?}',   [Imet\ImetEvalControllerV2::class, 'edit']);
                    Route::get('{item}/show/{step?}',   [Imet\ImetEvalControllerV2::class, 'show']);
                    Route::get('{item}/print',          [Imet\ImetEvalControllerV2::class, 'print']);
                    Route::patch('{item}',           [Imet\ImetEvalControllerV2::class, 'update']);
                });
                Route::group(['prefix' => 'report'], function () {
                    Route::get('{item}/edit', [Imet\ImetControllerV2::class, 'report']);
                    Route::get('{item}/show', [Imet\ImetControllerV2::class, 'report_show']);
                    Route::patch('{item}', [Imet\ImetControllerV2::class, 'report_update']);
                });

            });

        });

    });

    Route::group(['prefix' => 'api/'], function () {
        Route::get('imet/assessment/{item}/{step?}', [Imet\ImetEvalController::class, 'assessment']);

    });

});