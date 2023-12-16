<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
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



Route::prefix('/course')->name('course.')->group(function(){
    Route::get('/', [CourseController::class, 'index'])->name('all');
    Route::post('/', [CourseController::class, 'store'])->name('create');
    Route::get('/{id}', [CourseController::class, 'show'])->name('one');
    Route::get('/students/{id}', [CourseController::class, 'showWithStudents'])->name('oneWithStudents');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{id}', [CourseController::class, 'destroy'])->name('delete');
});
Route::prefix('/student')->name('student.')->group(function(){
    Route::get('/', [StudentController::class, 'index'])->name('all');
    Route::post('/', [StudentController::class, 'store'])->name('create');
    Route::get('/{id}', [StudentController::class, 'show'])->name('one');
    Route::get('/courses/{id}', [StudentController::class, 'showWithCourses'])->name('oneWithCourses');
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');
    Route::post('/{student_id}/enroll/{course_id}', [StudentController::class, 'enroll'])->name('enroll');
});