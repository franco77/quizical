<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/quizzes', 'QuestionController@index');
Route::get('/quizzes/quiz/{quiz}', 'QuestionController@show');
Route::get('/quizzes/quiz/{quiz}/questions', 'QuestionController@questions');
Route::post('/quizzes/quiz/{quiz}/results', 'QuestionController@results');

Route::get('/create-question/{quiz}', 'QuizController@newquestion');
Route::post('/create-quiz', 'QuizController@create');
Route::get('/edit-quiz/{quiz}', 'QuizController@edit');
Route::post('/edit-quiz/{quiz}', 'QuizController@changeQuizName');
Route::post('/create-question/{quiz}', 'QuizController@store');
Route::get('/edit-quiz/{quiz}/question/{question}', 'QuizController@showEditQuestion');
Route::post('/edit-quiz/{quiz}/question/{question}', 'QuizController@editQuestion');
Route::delete('/delete-quiz/{quiz}/question/{question}', 'QuizController@destroyQuestion');
Route::delete('/delete-quiz/{quiz}', 'QuizController@destroy');
Route::get('/show-results/{quiz}', 'QuizController@show');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

    