<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScreenShotApiController;
use App\Http\Controllers\ApiForSitesLikeTFController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->name('api.v1')->group(function () {
    Route::get('getMeta', [ScreenShotApiController::class, 'api']);
});

Route::get('metadata', [ApiForSitesLikeTFController::class, 'api']);
