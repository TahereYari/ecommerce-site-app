<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('verifyLicense', [App\Http\Controllers\Api\LicenseApiController::class, 'verifyLicense'])->name('verifyLicense');
Route::post('checkLicenseExpiration', [App\Http\Controllers\Api\LicenseApiController::class, 'checkLicenseExpiration'])->name('check_license_expiration');
