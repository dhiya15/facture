<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DarJma3aExpenseController;
use App\Http\Controllers\GivewayController;
use App\Http\Controllers\Jam3iyaExpenseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberParticipationController;
use App\Http\Controllers\MemberYearController;
use App\Http\Controllers\RevenuesController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\YearController;
use App\Models\MemberYear;
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

Route::group(['prefix' => 'members'], function() {
    Route::post('/create', [MemberController::class, 'create']);
    Route::get('/get-all', [MemberController::class, 'getAll']);
    Route::post('/update', [MemberController::class, 'update']);
    Route::post('/delete', [MemberController::class, 'delete']);
});

Route::group(['prefix' => 'expenses-jam3iya'], function() {
    Route::post('/create', [Jam3iyaExpenseController::class, 'create']);
    Route::get('/get-all', [Jam3iyaExpenseController::class, 'getAll']);
    Route::post('/update', [Jam3iyaExpenseController::class, 'update']);
    Route::post('/delete', [Jam3iyaExpenseController::class, 'delete']);
});

Route::group(['prefix' => 'expenses-dar-jma3a'], function() {
    Route::post('/create', [DarJma3aExpenseController::class, 'create']);
    Route::get('/get-all', [DarJma3aExpenseController::class, 'getAll']);
    Route::post('/update', [DarJma3aExpenseController::class, 'update']);
    Route::post('/delete', [DarJma3aExpenseController::class, 'delete']);
});

Route::group(['prefix' => 'years'], function() {
    Route::post('/create', [YearController::class, 'create']);
    Route::get('/get-all', [YearController::class, 'getAll']);
    Route::post('/update', [YearController::class, 'update']);
    Route::post('/delete', [YearController::class, 'delete']);
});

Route::group(['prefix' => 'types'], function() {
    Route::post('/create', [TypeController::class, 'create']);
    Route::get('/get-all', [TypeController::class, 'getAll']);
    Route::post('/update', [TypeController::class, 'update']);
    Route::post('/delete', [TypeController::class, 'delete']);
});

Route::group(['prefix' => 'members-participation'], function() {
    Route::post('/create', [MemberYearController::class, 'create']);
    Route::get('/get-all/{id}', [MemberYearController::class, 'getAll']);
    Route::post('/update', [MemberYearController::class, 'update']);
    Route::post('/delete', [MemberYearController::class, 'delete']);
});

Route::prefix('admin')->group(function () {
    Route::post('/register',[AdminController::class,'register']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/get-my-info', [AdminController::class, 'getMyInfo']);
    Route::post('/update-password', [AdminController::class, 'updatePassword']);
});

Route::group(['prefix' => 'giveway'], function() {
    Route::post('/create', [GivewayController::class, 'create']);
    Route::get('/get-all', [GivewayController::class, 'getAll']);
    Route::post('/update', [GivewayController::class, 'update']);
    Route::post('/delete', [GivewayController::class, 'delete']);
});

Route::group(['prefix' => 'revenues'], function() {
    Route::post('/create', [RevenuesController::class, 'create']);
    Route::get('/get-all', [RevenuesController::class, 'getAll']);
    Route::post('/update', [RevenuesController::class, 'update']);
    Route::post('/delete', [RevenuesController::class, 'delete']);
});

Route::post('/upload-members', [Controller::class, 'uploadMembers']);
