<?php

use App\Http\Controllers\MicrofinanceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Microfinance routes
Route::prefix('microfinances')->group(function () {
    Route::get('/', [MicrofinanceController::class, 'index']);
    Route::post('/', [MicrofinanceController::class, 'store']);
    Route::get('/{microfinance}', [MicrofinanceController::class, 'show']);
    Route::put('/{microfinance}', [MicrofinanceController::class, 'update']);
    Route::delete('/{microfinance}', [MicrofinanceController::class, 'destroy']);
});

// Member routes
Route::prefix('members')->group(function () {
    Route::get('/', [MemberController::class, 'index']);
    Route::post('/', [MemberController::class, 'store']);
    Route::get('/{member}', [MemberController::class, 'show']);
    Route::put('/{member}', [MemberController::class, 'update']);
    Route::delete('/{member}', [MemberController::class, 'destroy']);
    Route::put('/activate', [MemberController::class, 'activate']);
});

// Loan routes
Route::prefix('loans')->group(function () {
    Route::get('/', [LoanController::class, 'index']);
    Route::post('/', [LoanController::class, 'store']);
    Route::get('/{loan}', [LoanController::class, 'show']);
    Route::put('/{loan}', [LoanController::class, 'update']);
    Route::delete('/{loan}', [LoanController::class, 'destroy']);
});

// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'message' => 'SACCO API is running',
        'timestamp' => now()->toISOString()
    ]);
});
