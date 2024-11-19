<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/createUser', [UserController::class, 'createUser']);
Route::post('/signInUser', [UserController::class, 'loginUser']);
Route::post('/updatePaymentStatus/{user_id}', [UserController::class, 'updatePaymentStatus']);
Route::post('/updatePdfText/{user_id}', [UserController::class, 'updatePDFText']);
Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
