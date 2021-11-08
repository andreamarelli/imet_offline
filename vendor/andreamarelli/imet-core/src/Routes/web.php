<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1;
use AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV1;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2;
use AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV1;
use AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV2;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpBasketController;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['setLocale', 'web']], function () {


    Route::group(['prefix' => 'admin/imet', 'middleware' => 'auth'], function () {

        // ####  common routes (v1 & v2) ####
        Route::match(['get', 'post'],'/',      [Controller::class, 'index'])->name('index');
        Route::match(['get', 'post'],'v1',      [Controller::class, 'index']);     // temporary alias
        Route::match(['get', 'post'],'v2',      [Controller::class, 'index']);     // temporary alias
        Route::delete('{item}', [Controller::class, 'destroy']);
        Route::get('{item}/export', [Controller::class, 'export']);
        Route::match(['get','post'],'export_view',        [Controller::class, 'export_view'])->name('export_view');

        Route::post('ajax/upload', [Controller::class, 'upload']);
        Route::get('import',        [Controller::class, 'import_view']);
        Route::post('import',      [Controller::class, 'import']);
        Route::get('{item}/merge',  [Controller::class, 'merge_view']);
        Route::post('merge',      [Controller::class, 'merge']);

        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}', [ControllerV1::class, 'edit']);
                Route::patch('{item}',           [ControllerV1::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}', [EvalControllerV1::class, 'edit']);
                Route::patch('{item}',           [EvalControllerV1::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [ReportControllerV1::class, 'report']);
                Route::get('{item}/show', [ReportControllerV1::class, 'report_show']);
                Route::patch('{item}', [ReportControllerV1::class, 'report_update']);
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function () {
            Route::get('{item}/print',       [ControllerV2::class, 'print']);

            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}',[ControllerV2::class, 'edit']);
                Route::get('{item}/show/{step?}',[ControllerV2::class, 'show']);
                Route::patch('{item}',           [ControllerV2::class, 'update']);
                Route::get('create',            [ControllerV2::class, 'create']);
                Route::get('create_non_wdpa', [ControllerV2::class, 'create_non_wdpa']);
                Route::post('store',            [ControllerV2::class, 'store']);
                Route::post('prev_years',            [ControllerV2::class, 'retrieve_prev_years']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}',   [EvalControllerV2::class, 'edit']);
                Route::get('{item}/show/{step?}',   [EvalControllerV2::class, 'show']);
                Route::get('{item}/print',          [EvalControllerV2::class, 'print']);
                Route::patch('{item}',           [EvalControllerV2::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [ReportControllerV2::class, 'report']);
                Route::get('{item}/show', [ReportControllerV2::class, 'report_show']);
                Route::patch('{item}', [ReportControllerV2::class, 'report_update']);
            });

        });

        // Scaling Up Analysis
        Route::group(['prefix' => 'scaling_up'], function () {

            Route::get('/',      [Controller::class, 'scaling_up']);
            Route::get('download/{scaling_id}', [ScalingUpAnalysisController::class, 'download_zip_file'])->name('download_scaling_up_files');
            Route::get('{items}',    [ScalingUpAnalysisController::class, 'report_scaling_up'])->name('scaling_up');
            Route::get('preview/{id}',[ScalingUpAnalysisController::class, 'preview_template'])->name('scaling_up_preview');
            Route::post('analysis',     [ScalingUpAnalysisController::class, 'get_ajax_responses']);

            Route::group(['prefix' => 'basket'], function () {
                Route::post('add',   [ScalingUpBasketController::class, 'save']);
                Route::post('get',   [ScalingUpBasketController::class, 'retrieve']);
                Route::post('all',   [ScalingUpBasketController::class, 'all']);
                Route::delete('delete/{id}',[ScalingUpBasketController::class, 'delete']);
                Route::post('clear', [ScalingUpBasketController::class, 'clear']);
            });
        });

        Route::group(['prefix' => 'tools'], function () {
            Route::get('export_csv', [Controller::class, 'exportListCSV'])->name('csv_list');
            Route::get('export_csv/{ids}/{module_key}', [Controller::class, 'exportModuleToCsv'])->name('csv');
            Route::post('export_batch',        [Controller::class, 'export_batch'])->name('export_json_batch');
        });


    });

    // Roles
    Route::group(['prefix' => 'admin/role/imet'], function () {
        Route::match(['get', 'post'], 'imet', [RoleController::class, 'index']);
        Route::post('imet/grant', [RoleController::class, 'grant']);
        Route::post('imet/revoke', [RoleController::class, 'revoke']);
    });

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'api'], function () {

        Route::match(['get', 'post'], 'protected_areas/pairs',         [ProtectedAreaController::class, 'get_pairs']);

        Route::group(['prefix' => 'imet'], function () {
            Route::match(['get', 'post'], '/', [Controller::class, 'pame']);
            Route::get('assessment/{item}/{step?}', [EvalController::class, 'assessment']);
        });

    });

});

