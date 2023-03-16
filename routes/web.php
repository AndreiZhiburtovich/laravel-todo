<?php

use App\Http\Controllers\TaskController;
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
    return view('main');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', [TaskController::class, 'index'])->name('dashboard');

    Route::get('tasks/create', [TaskController::class, 'create']);
    Route::post('tasks', [TaskController::class, 'store']);

    Route::get('tasks/{task}/edit', [TaskController::class, 'edit']);
    Route::put('task/{task}', [TaskController::class, 'update']);

    Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    Route::delete('tasks', [TaskController::class, 'destroyAll']);
});
