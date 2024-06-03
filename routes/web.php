<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('index', function () {
    return redirect('/');
});
Route::get('/', 'ExamController@index')->name('home');

Route::middleware(['auth:student'])->group(function () {
    Route::get('exam/{exam}', 'ExamController@show')->name('exam.show');
    Route::post('exam/{exam}/submit', 'ExamController@submit')->name('exam.submit');
    Route::get('exam/{exam}/result', 'ExamController@result')->name('exam.result');
    Route::get('exam-attended', 'ExamController@attended')->name('exam.attended');
});
