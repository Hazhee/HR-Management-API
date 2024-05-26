<?php

use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\DepartmentController;
use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Employee Routes
    Route::get('employees/average-salary', [EmployeeController::class, 'averageSalaryByAgeGroup']);
    Route::get('employees/never-changed-department', [EmployeeController::class, 'neverChangedDepartment']);
    Route::apiResource('employees', EmployeeController::class);
    Route::get('employees/{employee}/managers', [EmployeeController::class, 'getManagers']);
    Route::get('employees/top-completed-projects/{department}', [EmployeeController::class, 'topCompletedProjects']);
    Route::post('employees/{employee}/change-department', [EmployeeController::class, 'changeDepartment']);

    // Department Routes
    Route::apiResource('departments', DepartmentController::class);
    Route::post('departments/{department}/assign-manager', [DepartmentController::class, 'assignManager']);

    // Project Routes
    Route::get('projects/average-duration', [ProjectController::class, 'averageProjectDuration']);
    Route::get('projects/search', [ProjectController::class, 'searchProjects']);
    Route::apiResource('projects', ProjectController::class);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


