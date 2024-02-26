<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'products'], function() {
    Route::post('/create', [ProductController::class, 'create']);
    Route::get('/get-all', [ProductController::class, 'getAll']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::post('/delete', [ProductController::class, 'delete']);
});

Route::group(['prefix' => 'members'], function() {
    Route::post('/create', [MemberController::class, 'create']);
    Route::get('/get-all', [MemberController::class, 'getAll']);
    Route::post('/update', [MemberController::class, 'update']);
    Route::post('/delete', [MemberController::class, 'delete']);
});

Route::group(['prefix' => 'infos'], function() {
    Route::post('/create', [InfoController::class, 'create']);
    Route::get('/get-all', [InfoController::class, 'getAll']);
    Route::post('/update', [InfoController::class, 'update']);
    Route::post('/delete', [InfoController::class, 'delete']);
});

Route::prefix('admin')->group(function () {
    Route::post('/register',[AdminController::class,'register']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/get-my-info', [AdminController::class, 'getMyInfo']);
    Route::post('/update-password', [AdminController::class, 'updatePassword']);
});

Route::post('/upload-members', [Controller::class, 'uploadMembers']);
