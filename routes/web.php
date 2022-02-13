<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use \App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\MainController;


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('panel',[MainController::class,'dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}',[MainController::class,'quiz_detail'])->name('quiz_detail');
    Route::get('quiz/{slug}',[MainController::class,'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result',[MainController::class,'result'])->name('quiz.result');
});


Route::group(['middleware' => ['auth', 'isadmin'], 'prefix' => 'admin'], function () {
    Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->WhereNumber('id')->name('quizzes.destroy');
    Route::resource('quizzes', QuizController::class);
//    Route::resource('question', QuestionController::class);
    Route::group(['prefix' => "question", "as" => "question."], function () {
        Route::get('/{id}', [QuestionController::class, 'index'])->name('index');
        Route::get('/create/{id}', [QuestionController::class, 'create'])->name('create');
        Route::get('/store/{id}', [QuestionController::class, 'store'])->name('store');
Route::get('/edit/{quiz_id}/{question_id}', [QuestionController::class, 'edit'])->name('edit');
        Route::get('/update/{quiz_id}/{question_id}', [QuestionController::class, 'update'])->name('update');
        Route::get('/destroy/{quiz_id}/{question_id}', [QuestionController::class, 'destroy'])->WhereNumber('question_id')->name('destroy');
    });

});

