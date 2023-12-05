<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;


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

Route::get('/api-docs.json', 'GreetController@apiDocs');

Route::get('/info', [InfoController::class, 'index'])->name('info');
Route::get('/greet', [GreetController::class,'greet'])->name('greet');
Route::get('/getPicture', [GreetController::class,'getPicture'])->name('apiGetPicture');
Route::post('/postPicture', [GreetController::class,'storePicture'])->name('apiPostPicture');
