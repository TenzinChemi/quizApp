<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Question\SelectSubject;
use App\Http\Controllers\Question\SingleQuestionController;
use App\Http\Controllers\Question\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Models\SubjectCategory;
use Illuminate\Support\Facades\Route;

/**
 * Admin login
 */


Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('post-login',[UserController::class,'postLogin'])->name('login.post');


/**
 * Admin Controller
 */

Route::group(['middleware' => ['auth','isAdmin']], function(){

    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    // Route::resource('singleQuestion',QuestionController::class);

    //Endpoints for subjects
    // Route::get('subject',[SubjectController::class,'index']);
    Route::get('subject/create',[SubjectController::class,'create']);
    Route::post('subject/store',[SubjectController::class,'store'])->name('subject.store');

    //endpoints for SingleQuestion
    Route::get('singleQuestion/create',[SingleQuestionController::class,'create']);
    Route::match(array('GET','POST'),'singleQuestion/store',[SingleQuestionController::class,'store'])->name('singlequestion.store');


    Route::post('logout',[UserController::class,'logout']);

});










