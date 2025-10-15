<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MembershipController;
use App\Models\Membership;

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

Route::get('/ping', function() {
    return response()->json(['message' => 'pong']);
});


//MEDIA ROUTES
Route::get('/media/search', [MediaController::class, 'search']);

Route::get('/media', [MediaController::class, 'index']);

Route::get('/media/search', [MediaController::class, 'search']);

Route::get('/media/{id}', [MediaController::class, 'show']);


//USER ROUTES
Route::post('user/login', [UserController::class, 'login']);

Route::post('user/signUp', [UserController::class, 'signup']);


//MEMBESHIP ROUTES
Route::get('/membership', [MembershipController::class, 'index']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::post('/membership/subscribe', [MembershipController::class, 'subscribe']);
});

Route::middleware(['jwt.auth'])->get('/ping', [UserController::class, 'ping']);