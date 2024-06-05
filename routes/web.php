<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['auth' ,\App\Http\Middleware\CheckIfManager::class]], function() {
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('departments', \App\Http\Controllers\DepartmentController::class);

    });
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::put('tasks/update/Status', [\App\Http\Controllers\TaskController::class , 'updateStatus'])->name('tasks.updateStatus');

});
