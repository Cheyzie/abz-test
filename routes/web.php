<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Models\Employee;
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
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
        ->name('admin.employees.edit');
    Route::patch('/employees/{employee}', [EmployeeController::class, 'update'])
        ->name('admin.employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
        ->name('admin.employees.destroy');

    Route::get('/positions', [PositionController::class, 'index']);
    Route::get('/positions/create', [PositionController::class, 'create']);
    Route::post('/positions', [PositionController::class, 'store']);
    Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])
        ->name('admin.position.edit');
    Route::patch('/positions/{position}', [PositionController::class, 'update'])
        ->name('admin.position.update');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])
        ->name('admin.position.destroy');

    Route::get('autocomplete/employees', [AutoCompleteController::class, 'employees'])
        ->name('autocomplete.employees');
});
