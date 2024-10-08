<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;

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

Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index']);  // List employees
    Route::post('employees', [EmployeeController::class, 'store']);  // Add employee
    Route::put('employees/{id}', [EmployeeController::class, 'update']);  // Edit employee
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);

    // leave
    Route::get('leave-requests', [LeaveRequestController::class, 'index']);  // List leave requests
    Route::put('leave-requests/{id}/accept', [LeaveRequestController::class, 'accept']);  // Accept leave request
    Route::put('leave-requests/{id}/reject', [LeaveRequestController::class, 'reject']);  // Reject leave request
});
