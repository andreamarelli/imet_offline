<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'imet'], function () {

        Route::match(['get', 'post'], '/', [Controller::class, 'pame']);
        Route::get('scores/{item}', [ApiController::class, 'scores'])->name('imet_core::api::scores');
        Route::get('scores_oecm/{item}', [ApiController::class, 'scores_oecm'])->name('imet_core::api::scores_oecm');
        Route::get('{lang}/protected-areas-list', [ApiController::class, 'get_protected_areas_list'])->name('imet_core::api::get_protected_areas_list');
        Route::get('total-number-of-assessments', [ApiController::class, 'get_total_number_of_assessments'])->name('imet_core::api::statistics.total_number_of_assessments');
        Route::get('pas-rating', [ApiController::class, 'get_pas_rating'])->name('imet_core::api::statistics.pas_rating');
        Route::get('assessments-performed-by-year', [ApiController::class, 'get_assessments_performed_by_year'])->name('imet_core::api::statistics.assessments_performed_by_year');
        Route::get('assessments-performed-by-country', [ApiController::class, 'get_assessments_performed_by_country'])->name('imet_core::api::statistics.assessments_performed_by_country');
        Route::get('{lang}/global-statistics/{slug}/{year?}', [ApiController::class, 'get_global_statistics'])->name('imet_core::api::statistics.global');
        Route::get('{lang}/assessment-global-average-scores', [ApiController::class, 'get_global_average_scores']);

        Route::group(['middleware' => ['auth:api', 'apiValidation']], function () {
            Route::get('{lang}/assessment/report/{wdpa_id}/{year?}', [ApiController::class, 'get_assessment_report']);
            Route::get('{lang}/statistics/radar/{wdpa_id}/{year?}', [ApiController::class, 'get_imet_statistics_radar']);
            Route::get('{lang}/details/{key}/{wdpa_id}/{year?}', [ApiController::class, 'get_imet'])->name('imet_core::api::imet_details');
            Route::get('{lang}/details/{key}/{form_id}/{year?}', [ApiController::class, 'get_imet'])->name('imet_core::api::oecm_details');


            Route::group(['prefix' => '{lang}/scaling-up'], function () {
                Route::get('general-info/{wdpa_id}/{year?}', [ApiController::class, 'get_general_info']);
                Route::group(['prefix' => 'groups'], function () {
                    Route::get('by-groups', [ApiController::class, 'get_analysis_group']);
                    Route::get('by-pa-group-and-synthetic-indicators-group', [ApiController::class, 'get_analysis_group_and_indicators_group']);
                });
                Route::group(['prefix' => 'overall'], function () {
                    Route::get('ranking/{wdpa_id}/{year?}', [ApiController::class, 'get_overall_ranking']);
                    Route::get('averages/{wdpa_id}/{year?}', [ApiController::class, 'get_overall_average_of_six_elements']);
                    Route::get('data-synthetic-indicators/{wdpa_id}/{year?}', [ApiController::class, 'get_visualization_synthetics_indicators']);
                    Route::get('synthetic-indicators/{wdpa_id}/{year?}', [ApiController::class, 'get_scatter_visualization_synthetic_indicators']);
                });
                Route::group(['prefix' => 'elements'], function () {
                    Route::get('key-conservation/{wdpa_id}/{year?}', [ApiController::class, 'get_key_elements_conservation']);
                });
                Route::group(['prefix' => 'analysis'], function () {
                    Route::get('ranking/{slug}/{wdpa_id}/{year?}', [ApiController::class, 'get_analysis_ranking']);
                    Route::get('average/{slug}/{wdpa_id}/{year?}', [ApiController::class, 'get_analysis_average']);
                    Route::get('data-upper-lower-average/{slug}/{wdpa_id}/{year?}', [ApiController::class, 'get_analysis_radar']);
                    Route::get('data/{slug}/{wdpa_id}/{year?}', [ApiController::class, 'get_analysis_table']);
                });
            });
        });
    });
});
