<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkShiftController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [UserController::class, 'login'])
    ->withoutMiddleware('auth:api');
Route::get('/logout', [UserController::class, 'logout']);

Route::apiResource('/user', UserController::class, ['only' => ['index', 'store']])
    ->middleware('role:admin');


Route::prefix('work-shift')
    ->middleware('role:admin')
    ->group(function () {
        Route::post('/', [WorkShiftController::class, 'store']);
        Route::get('/{id}/open', [WorkShiftController::class, 'open']);
        Route::get('/{id}/close', [WorkShiftController::class, 'close']);
        Route::post('/{id}/user', [WorkShiftController::class, 'addUser']);
    });
Route::get('/work-shift/{id}/order', [WorkShiftController::class, 'orders'])
    ->middleware('role:admin|waiter');

Route::apiResource('/order', OrderController::class, ['only' => ['show', 'store']]);

Route::prefix('order')
    ->middleware('role:waiter')
    ->group(function () {
        Route::post('/{id}/position', [OrderController::class, 'addPosition']);
        Route::delete('/{id}/position/{order_menu}', [OrderController::class, 'removePosition']);
    });
Route::patch('order/{id}/change_status', [OrderController::class, 'changeStatus'])
    ->middleware('role:waiter|cook');
Route::get('/taken', [OrderController::class, 'takenOrders'])
    ->middleware('role:waiter|cook');
