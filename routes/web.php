<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('home', fn () => redirect('tasks/today'))->name('home');
    Route::get('tasks/{description}', [TaskController::class, 'index'])->name('tasks');
    Route::get('task-count/{description}', [TaskController::class, 'getTasksCount']);
    Route::resource('tasks', TaskController::class);
});
