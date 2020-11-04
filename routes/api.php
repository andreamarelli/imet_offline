<?php

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

if(!App::environment('imetoffline')){

    // ####  Analytical Platform APIs  ####
    Route::group(['prefix' => 'analysis'], function () {

        // # Forest Management #
        Route::match(['get', 'post'],'forest_management/regional','AnalyticalPlatform\ForestManagement\RegionalController@api');
        Route::match(['get', 'post'],'forest_management/national/{item}','AnalyticalPlatform\ForestManagement\NationalController@api');
        Route::match(['get', 'post'],'forest_management/concessions/{item}','AnalyticalPlatform\ForestManagement\LocalController@api');
        // # Biodiversity #
        Route::match(['get', 'post'],'biodiversity/regional', 'AnalyticalPlatform\Biodiversity\RegionalController@api');
        Route::match(['get', 'post'],'biodiversity/national/{item}','AnalyticalPlatform\Biodiversity\NationalController@api');
        Route::match(['get', 'post'],'biodiversity/protected_areas/{item}','AnalyticalPlatform\Biodiversity\LocalController@api');
        // # Legal Framework #
        Route::match(['get', 'post'],'legal_framework/regional','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'legal_framework/national/{item}','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'legal_framework/concessions/{item}','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'legal_framework/protected_areas/{item}','Controller@under_dev');  // TODO
        // # Climate Change #
        Route::match(['get', 'post'],'climate_change/regional','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'climate_change/national/{item}','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'climate_change/concessions/{item}','Controller@under_dev');  // TODO
        Route::match(['get', 'post'],'climate_change/protected_areas/{item}','Controller@under_dev');  // TODO

        // # Library #
        Route::match(['get', 'post'],'library','CatalogueController@analysis');

        // # Projects #
        Route::match(['get', 'post'],'projects','Project\ProjectController@analysis');

    });

    // IMET
    Route::group(['prefix' => 'imet'], function () {
        Route::match(['get', 'post'],'/','Imet\ImetController@api_pame');
    });

    // Protected Area
    Route::group(['prefix' => 'protected_area'], function () {
        Route::get('/','ProtectedAreaController@api_list');
        Route::get('/{item}','ProtectedAreaController@api_info');
    });


    // Projects
    Route::group(['prefix' => 'project'], function () {
        Route::match(['get', 'post'], 'stats', 'Project\ProjectController@api_stats');
        Route::match(['get', 'post'], 'stats/lambda', 'Project\ProjectController@api_stats');
        Route::get('stats/monitoring/{item}', 'Project\ProjectController@api_monitoring');
    });

    // NationalIndicators
    Route::group(['prefix' => 'national'], function () {
        Route::post('indicators/preload', 'NationalIndicators\_Controller@retrievePreloadData');
    });

    // Concession & Concessions' indicators
    Route::group(['prefix' => 'concession'], function () {
        Route::post('indicators/preload','ConcessionIndicators\ConcessionIndicatorsController@retrievePreloadData');
    });

    // Library
    Route::group(['prefix' => 'library'], function () {
        Route::post('getKeywords',      'CatalogueController@getKeywords');
        Route::post('createKeywords',   'CatalogueController@createKeywords');
    });

}