<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ModularForms\Controllers\UploadFileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', function () { return Redirect::to('confirm_user'); });
    Route::view('welcome', 'offline.welcome')->name('welcome');

    // Settings routes
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::patch('settings/update', [SettingsController::class, 'update'])->name('settings_update');
    Route::get('update', [UpdateController::class, 'index'])->name('update');
    Route::post('update', [UpdateController::class, 'update'])->name('update.apply');
    Route::get('update/done', [UpdateController::class, 'done'])->name('update.done');
    Route::get('channel/beta', [UpdateController::class, 'switch_to_beta'])->name('channel.switch_to_beta');
    Route::get('channel/stable', [UpdateController::class, 'switch_to_stable'])->name('channel.switch_to_stable');

    // User routes
    Route::get('users/{role_type?}', [UserController::class, 'index'])->name('imet-core::users');
    Route::patch('users', [UserController::class, 'update_roles'])->name('imet-core::users_update');
    Route::get('confirm_user', [UserController::class, 'confirm_offline_user']);
    Route::patch('confirm_user', [UserController::class, 'update_offline_user'])->name('update_offline_user');

    // ###### File upload/download ######
    Route::post('file/upload', [UploadFileController::class, 'upload'])->name('upload.file');
    Route::get('file/{hash}', [UploadFileController::class, 'download'])->name('file');

    // Debug/dev
    Route::get('info', function (){ return phpinfo(); });
    // logs : managed directly by opcodesio/log-viewer package

});

