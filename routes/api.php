<?php

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if(!is_imet_environment()){

    // ####  Analytical Platform APIs  ####
    Route::group(['prefix' => 'analysis'], function () {

        // # Forest Management #
        Route::match(['get', 'post'],'forest_management/regional',[Controllers\AnalyticalPlatform\ForestManagement\RegionalController::class, 'api']);
        Route::match(['get', 'post'],'forest_management/national/{item}',[Controllers\AnalyticalPlatform\ForestManagement\NationalController::class, 'api']);
        Route::match(['get', 'post'],'forest_management/concessions/{item}',[Controllers\AnalyticalPlatform\ForestManagement\LocalController::class, 'api']);
        // # Biodiversity #
        Route::match(['get', 'post'],'biodiversity/regional', [Controllers\AnalyticalPlatform\Biodiversity\RegionalController::class, 'api']);
        Route::match(['get', 'post'],'biodiversity/national/{item}',[Controllers\AnalyticalPlatform\Biodiversity\NationalController::class, 'api']);
        Route::match(['get', 'post'],'biodiversity/protected_areas/{item}',[Controllers\AnalyticalPlatform\Biodiversity\LocalController::class, 'api']);
        // # Legal Framework #
        Route::match(['get', 'post'],'legal_framework/regional',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'legal_framework/national/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'legal_framework/concessions/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'legal_framework/protected_areas/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO
        // # Climate Change #
        Route::match(['get', 'post'],'climate_change/regional',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'climate_change/national/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'climate_change/concessions/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO
        Route::match(['get', 'post'],'climate_change/protected_areas/{item}',[Controllers\Controller::class, 'under_dev']);  // TODO

        // # Library #
        Route::match(['get', 'post'],'library',[Controllers\CatalogueController::class, 'analysis']);

        // # Projects #
        Route::match(['get', 'post'],'projects',[Controllers\Project\ProjectController::class, 'analysis']);

    });

    // IMET
    Route::group(['prefix' => 'imet'], function () {
        Route::match(['get', 'post'],'/',[Controllers\Imet\ImetController::class, 'api_pame']);
    });

    // Protected Area
    Route::group(['prefix' => 'protected_area'], function () {
        Route::get('/',[Controllers\ProtectedAreaController::class, 'api_list']);
        Route::get('/{item}',[Controllers\ProtectedAreaController::class, 'api_info']);
    });


    // Projects
    Route::group(['prefix' => 'project'], function () {
        Route::match(['get', 'post'], 'stats', [Controllers\Project\ProjectController::class, 'api_stats']);
        Route::match(['get', 'post'], 'stats/lambda', [Controllers\Project\ProjectController::class, 'api_stats']);
        Route::get('stats/monitoring/{item}', [Controllers\Project\ProjectController::class, 'api_monitoring']);
    });

    // NationalIndicators
    Route::group(['prefix' => 'national'], function () {
        Route::post('indicators/preload', [Controllers\NationalIndicators\_Controller::class, 'retrievePreloadData']);
    });

    // Concession & Concessions' indicators
    Route::group(['prefix' => 'concession'], function () {
        Route::post('indicators/preload',[Controllers\ConcessionIndicators\ConcessionIndicatorsController::class, 'retrievePreloadData']);
    });

    // Library
    Route::group(['prefix' => 'library'], function () {
        Route::post('getKeywords',      [Controllers\CatalogueController::class, 'getKeywords']);
        Route::post('createKeywords',   [Controllers\CatalogueController::class, 'createKeywords']);
    });

}
