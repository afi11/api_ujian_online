<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HistoriQuestionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FinishExamController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
    Route::resource('schedule', ScheduleController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('student', StudentController::class);
    Route::resource('history_exam', HistoriQuestionController::class);
    Route::get('nav_exam', [HistoriQuestionController::class, 'showExamNavigation']);
    Route::post('answer',[ExamController::class, 'answer']);
    Route::get('count_question', [ExamController::class, 'countQuestion']);
    Route::get('get_answer',[ExamController::class, 'checkAnswer']);
    Route::post('doubht_answer',[ExamController::class, 'addDoubht']);
    Route::resource('finish_exam', FinishExamController::class);
    Route::get('check_exam/{id}', [FinishExamController::class, 'checkExam']);
    Route::resource('scores', ScoreController::class);
    Route::get('dashboard', [DashboardController::class, 'index']);
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('get_user/{id}', [AuthController::class, 'getUser']);

