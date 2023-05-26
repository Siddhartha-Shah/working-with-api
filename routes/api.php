<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FileController;
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

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get("/get/{id?}",[EmployeeController::class,"getall"]);
    Route::post("/add",[EmployeeController::class,"add"]);
    Route::put("update",[EmployeeController::class,"update"]);
    Route::get("search/{name}",[EmployeeController::class,"search"]);
    Route::delete("delete/{id}",[EmployeeController::class,"delete"]);
    Route::post("save",[EmployeeController::class,"testData"]);
    Route::apiResource("/index",MemberController::class);

    });
    Route::post("/uploadfile",[FileController::class,"uploadFile"]);
    Route::post("login",[EmployeeController::class,'index']);


