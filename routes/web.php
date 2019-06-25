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

Route::get('/', function(){
	if(Auth::check())
	return view('home.index');
	else
	return view('home.login');
});

Route::post('demo','Demo@post');
Route::get('demo', 'Demo@post');
Route::get('login', 'LoginController@login');
Route::post('login','LoginController@postLogin');
Route::group(['middleware' => 'auth'], function(){
	Route::get('logout', 'HomeController@getLogout');
	Route::get('change-password', 'HomeController@getChangePassword');
	Route::post('change-password/post', 'HomeController@postChangePassword');
});



Route::group(['prefix' => 'student-manager', 'middleware' => 'Admin'], function(){
	Route::get('', 'HomeController@getStudentManager');
	Route::post('add', 'StudentManagerController@postAdd');
	Route::post('edit', 'StudentManagerController@postEdit');
	Route::post('delete', 'StudentManagerController@postDelete');
	Route::post('upload', 'StudentManagerController@postUpload');
	Route::post('reset', 'StudentManagerController@postReset');
});

Route::group(['prefix' => 'lecturers-manager', 'middleware' => 'Admin'], function(){
	Route::get('', 'HomeController@getLecturersManager');
	Route::post('add', 'LecturersManagerController@postAdd');
	Route::post('edit', 'LecturersManagerController@postEdit');
	Route::post('delete', 'LecturersManagerController@postDelete');
	Route::post('upload', 'LecturersManagerController@postUpload');
	Route::post('reset', 'LecturersManagerController@postReset');
});

Route::group(['prefix' => 'survey-manager', 'middleware' => 'Admin'], function(){
	Route::get('', 'HomeController@getSurveyManager');
	Route::post('upload', 'SurveyManagerController@postUpload');
	Route::post('editlmh', 'SurveyManagerController@postEditLMH');
	Route::post('rqStList', 'SurveyManagerController@rqStList');
	Route::post('deleteLMH', 'SurveyManagerController@postDeleteLMH');
	Route::post('addTC', 'SurveyManagerController@postAddTC' );
	Route::post('editTC', 'SurveyManagerController@postEditTC' );
	Route::post('deleteTC', 'SurveyManagerController@postDeleteTC' );
});
Route::group(['prefix' => 'report', 'middleware' => 'Admin'], function(){
	Route::get('', 'HomeController@getReport');
	Route::post('lmhnodata', 'ReportController@postLMHNoData');
	Route::post('lmhyesdata', 'ReportController@postLMHYesData');
	Route::get('downloadpdf', function(){return redirect('/report');});
	Route::post('downloadpdf', 'ReportController@postDownloadPdf');
	Route::post('surveyfinish','ReportController@postFinish');
});



Route::group(['prefix' => 'lecturers-report', 'middleware' => 'Lecturers'], function(){
	Route::get('', 'HomeController@getLecturersReport');
	Route::post('lmhnodata', 'LecturersReportController@postLMHNoData');
	Route::post('lmhyesdata', 'LecturersReportController@postLMHYesData');
	Route::get('downloadpdf', function(){return redirect('/lecturers-report');});
	Route::post('downloadpdf', 'LecturersReportController@postDownloadPdf');
	
});

Route::group(['prefix' => 'class-survey', 'middleware' => 'Student'], function(){
	Route::get('', 'HomeController@getClassSurvey');
	Route::post('classlist', 'ClassSurveyController@postClassList');
	Route::post('addsurvey', 'ClassSurveyController@postAddSurvey');
	Route::post('tclist', 'ClassSurveyController@postTcList');
	
});

