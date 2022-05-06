<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/students',[StudentController::class,'index']);

Route::post('/add-student',[StudentController::class,'addStudent'])->name('student.add');

Route::get('/student/{id}',[StudentController::class,'getStudentById']);

Route::put('/student',[StudentController::class,'updataStuden'])->name('student.update');
