<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MeasurementController;


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

Route::post('/login', [AuthController::class, 'storeLogin']);

Route::post('/register', [AuthController::class, 'storeRegister']);

Route::post('/forget', [AuthController::class, 'storeForget']);

Route::get('/reset', [AuthController::class, 'storeReset']);

Route::get('/refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:api')->group(function() {

    Route::get('/logout', [AuthController::class, 'logout']); 

    Route::get('/get/user', [AuthController::class, 'getUser']);
    
    Route::patch('/change', [AuthController::class, 'update']);
    
    Route::get('/get-data', [Controller::class, 'index']);

    Route::group([
        'prefix' => 'crop'
    ], function () {

        Route::get('/', [CropController::class, 'index']);
        Route::post('/create', [CropController::class, 'store']);
        Route::get('/{crop}/show', [CropController::class, 'show']);
        Route::get('/{crop}/edit', [CropController::class, 'edit']);
        Route::patch('/{crop}/update', [CropController::class, 'update']);
        Route::delete('/{crop}/delete', [CropController::class, 'delete']);
        Route::get('/{id}/recovery', [CropController::class, 'recovery']);
        Route::delete('/{id}/forceDelete', [CropController::class, 'forceDelete']);
        Route::get('/trash', [CropController::class, 'showTrash']);

    }); 


    Route::group([
        'prefix' => 'crop-disease'
    ], function () {

        Route::get('/', [DiseaseController::class, 'index']);
        Route::get('/create', [DiseaseController::class, 'create']);
        Route::post('/create', [DiseaseController::class, 'store']);
        Route::get('/{disease}/show', [DiseaseController::class, 'show']);
        Route::get('/{disease}/edit', [DiseaseController::class, 'edit']);
        Route::patch('/{id}/update', [DiseaseController::class, 'update']);
        Route::delete('/{disease}/delete', [DiseaseController::class, 'delete']);
        Route::get('/{id}/recovery', [DiseaseController::class, 'recovery']);
        Route::delete('/{id}/forceDelete', [DiseaseController::class, 'forceDelete']);
        Route::get('/trash', [DiseaseController::class, 'showTrash']);

    });


    Route::group([
        'prefix' => 'measurement-condition'
    ], function () {

        Route::get('/', [MeasurementController::class, 'index']);
        Route::get('/create', [MeasurementController::class, 'create']);
        Route::post('/create', [MeasurementController::class, 'store']);
        Route::get('/{measurement}/show', [MeasurementController::class, 'show']);
        Route::get('/{measurement}/edit', [MeasurementController::class, 'edit']);
        Route::patch('/{id}/update', [MeasurementController::class, 'update']);
        Route::delete('/{measurement}/delete', [MeasurementController::class, 'delete']);
        Route::get('/{id}/recovery', [MeasurementController::class, 'recovery']);
        Route::delete('/{id}/forceDelete', [MeasurementController::class, 'forceDelete']);
        Route::get('/trash', [MeasurementController::class, 'showTrash']);

    }); 

    Route::group([
        'prefix' => 'user'
    ], function () {

        Route::get('/', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/{user}/show', [UserController::class, 'show']);
        Route::get('/{user}/edit', [UserController::class, 'edit']);
        Route::patch('/{user}/update', [UserController::class, 'update']);
        Route::delete('/{user}/delete', [UserController::class, 'delete']);

    }); 




});
