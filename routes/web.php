<?php

Route::get('file/{hash}',      'UploadFileController@download');

Route::group(['middleware' => 'setLocale'], function () {

    if (App::environment('imetoffline')) {
        Route::get('/', function () { return view('admin.imet.offline.welcome');});
        Route::get('welcome', function () { return view('admin.imet.offline.welcome'); });
        Route::get('admin', function () { return view('admin.imet.offline.welcome'); });
        Route::get('admin/imet/offline/close', function () { return view('admin.imet.offline.close'); });
        Route::get('admin/confirm_user', function () { return view('admin.imet.offline.confirm_user'); });
        Route::get('admin/offline_user', function () { return view('admin.imet.offline.edit_user'); });
        Route::patch('admin/staff/{item}', 'StaffController@update_offline');

        Route::group(['prefix' => 'ajax'], function () {
            Route::post('upload', 'UploadFileController@upload');
            Route::get('download', 'UploadFileController@download');
            Route::post('protected_areas/getLabels', 'ProtectedAreaController@getLabels');
            Route::group(['prefix' => 'search'], function () {
                Route::post('species', 'SpeciesController@search');
                Route::post('protected_areas', 'ProtectedAreaController@search');
            });
        });
    }

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'imet'], function () {

            // ####  common routes (v1 & v2) ####
            Route::match(['get', 'post'],'/',      'Imet\ImetController@index');
            Route::match(['get', 'post'],'v1',      'Imet\ImetController@index');     // temporary alias
            Route::match(['get', 'post'],'v2',      'Imet\ImetController@index');     // temporary alias
            Route::delete('{item}', 'Imet\ImetController@destroy');
            Route::get('{item}/export', 'Imet\ImetController@export');
            Route::get('import',        'Imet\ImetController@import_view');
            Route::post('import',      'Imet\ImetController@import');
            Route::get('{item}/merge',  'Imet\ImetController@merge_view');
            Route::post('merge',      'Imet\ImetController@merge');
            Route::post('{item}/upgrade',      'Imet\ImetController@upgrade');

            // #### IMET Version 1 ####
            Route::group(['prefix' => 'v1'], function () {
                Route::group(['prefix' => 'context'], function () {
                    Route::get('{item}/edit/{step?}', 'Imet\ImetControllerV1@edit');
                    Route::patch('{item}',           'Imet\ImetControllerV1@update');
                });
                Route::group(['prefix' => 'evaluation'], function () {
                    Route::get('{item}/edit/{step?}', 'Imet\ImetEvalControllerV1@edit');
                    Route::patch('{item}',           'Imet\ImetEvalControllerV1@update');
                });
            });

            // #### IMET Version 2 ####
            Route::group(['prefix' => 'v2'], function () {
                Route::get('{item}/print',       'Imet\ImetControllerV2@print');
                Route::get('{item}/pdf',       'Imet\ImetControllerV2@pdf');
                Route::get('{item}/report', 'Imet\ImetControllerV2@report');
                Route::patch('{item}/report', 'Imet\ImetControllerV2@report_update');

                Route::group(['prefix' => 'context'], function () {
                    Route::get('{item}/edit/{step?}','Imet\ImetControllerV2@edit');
                    Route::get('{item}/show/{step?}','Imet\ImetControllerV2@show');
                    Route::patch('{item}',           'Imet\ImetControllerV2@update');
                    Route::get('create',            'Imet\ImetControllerV2@create');
                    Route::post('store',            'Imet\ImetControllerV2@store');
                    Route::post('prev_years',            'Imet\ImetControllerV2@retrieve_prev_years');
                });
                Route::group(['prefix' => 'evaluation'], function () {
                    Route::get('{item}/edit/{step?}',   'Imet\ImetEvalControllerV2@edit');
                    Route::get('{item}/show/{step?}',   'Imet\ImetEvalControllerV2@show');
                    Route::get('{item}/print',          'Imet\ImetEvalControllerV2@print');
                    Route::patch('{item}',           'Imet\ImetEvalControllerV2@update');
                });
            });

        });

    });

    Route::group(['prefix' => 'api/'], function () {
        Route::get('imet/assessment/{item}/{step?}', 'Imet\ImetEvalController@assessment');

    });

});
