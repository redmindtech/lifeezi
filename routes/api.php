<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-measurements',[App\Http\Controllers\MeasurementController::class, 'getMeasurement'])->name('getMeasurement');
Route::get('/get-meals',[App\Http\Controllers\ObservationController::class, 'getMeals'])->name('getMeals');
Route::get('/getuploadlab',[App\Http\Controllers\UploadLabController::class, 'getUpload'])->name('getUpload');
Route::get('/get-meal-category',[App\Http\Controllers\PlanningController::class, 'getPlanningMeal'])->name('getPlanningMeal');
Route::get('/getClient',[App\Http\Controllers\ClientController::class, 'getClient'])->name('getClient'); 
Route::get('/getReportClient',[App\Http\Controllers\ReportController::class, 'getReportClient'])->name('getReportClient'); 
Route::get('/getSchedule',[App\Http\Controllers\ScheduleController::class, 'getSchedule'])->name('getSchedule');
Route::get('/getSummary',[App\Http\Controllers\SummaryController::class, 'getSummary'])->name('getSummary');
Route::get('/getOnboarding',[App\Http\Controllers\OnboardingController::class, 'getOnboarding'])->name('getOnboarding');
Route::get('/getObservation',[App\Http\Controllers\ObservationController::class, 'getObservation'])->name('getObservation');
Route::get('/getEmployee',[App\Http\Controllers\EmployeeController::class, 'getEmployee'])->name('getEmployee');
Route::get('/getClientObservation/{client}',[App\Http\Controllers\ObservationController::class, 'getClientObservation'])->name('getClientObservation');
Route::get('/getMeasurementData',[App\Http\Controllers\MeasurementController::class, 'getMeasurementData'])->name('getMeasurementData');
Route::get('/getClientMeasurement/{client}',[App\Http\Controllers\MeasurementController::class, 'getClientMeasurement'])->name('getClientMeasurement');
Route::get('/getUploadData',[App\Http\Controllers\UploadLabController::class, 'getUploadData'])->name('getUploadData');
Route::get('/getClientUpload/{client}',[App\Http\Controllers\UploadLabController::class, 'getClientUpload'])->name('getClientUpload');
Route::get('/getDisEngagement',[App\Http\Controllers\DisEngagementController::class, 'getDisEngagement'])->name('getDisEngagement');
Route::get('/getExpenses',[App\Http\Controllers\ExpenseController::class, 'getExpenses'])->name('getExpenses');
Route::get('/getPlanning',[App\Http\Controllers\PlanningController::class, 'getPlanning'])->name('getPlanning');
Route::get('/getFollowUp',[App\Http\Controllers\FollowUpController::class, 'getFollowUp'])->name('getFollowUp');
Route::get('/getReview',[App\Http\Controllers\ReviewController::class, 'getReview'])->name('getReview');
Route::get('/getPaymentData',[App\Http\Controllers\ClientPaymentController::class, 'getPaymentData'])->name('getPaymentData');
Route::get('/getClientPlanning/{client}',[App\Http\Controllers\PlanningController::class, 'getClientPlanning'])->name('getClientPlanning');
Route::get('/getClientFollowUp/{client}',[App\Http\Controllers\FollowUpController::class, 'getClientFollowUp'])->name('getClientFollowUp');
Route::get('/getClientReview/{client}',[App\Http\Controllers\ReviewController::class, 'getClientReview'])->name('getClientReview');




