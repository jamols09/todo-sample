<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index');
        Route::post('/tasks', 'store');
        Route::put('/tasks/{id}', 'update');
        Route::delete('/tasks/{id}', 'destroy');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});


