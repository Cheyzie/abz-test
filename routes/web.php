<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employees/create', [EmployeeController::class, 'create']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::get('/employees/{employee}', function (\App\Models\Employee $employee) { return $employee;})
        ->name('admin.employees.edit');

    Route::get('autocomplete/employees', [AutoCompleteController::class, 'employees'])
        ->name('autocomplete.employees');
});
