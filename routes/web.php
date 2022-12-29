<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientPaymentController;
use App\Http\Controllers\DisEngagementController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UploadLabController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Models\Client;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Str;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile.index');
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'profileStore'])->name('profile.store');
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('employee', EmployeeController::class);
});
Route::group(['middleware' => ['role:Admin|Employee','web']], function () {
    Route::resource('client', ClientController::class);
    Route::get('/client/{client}/onboarding/create', [App\Http\Controllers\OnboardingController::class, 'create'])->name('onboarding.add');
    Route::get('/onboarding/list', [App\Http\Controllers\OnboardingController::class, 'list'])->name('onboarding.list');
    Route::resource('onboarding', OnboardingController::class);
    Route::resource('measurement', MeasurementController::class);
    Route::get('/onboarding/{onboarding}/measurement', [App\Http\Controllers\MeasurementController::class, 'create'])->name('measurement.add');
    Route::resource('observation', ObservationController::class);
    Route::resource('upload', UploadLabController::class);
    Route::get('/client/{client}/measurement/list', [App\Http\Controllers\MeasurementController::class, 'list'])->name('measurement.list');
    Route::get('/client/{client}/upload', [App\Http\Controllers\UploadLabController::class, 'create'])->name('upload.add');
    Route::get('/client/{client}/upload/list', [App\Http\Controllers\UploadLabController::class, 'list'])->name('upload.list');
    Route::get('/client/{client}/observation', [App\Http\Controllers\ObservationController::class, 'create'])->name('observation.add');
    Route::get('/client/{client}/observation/list', [App\Http\Controllers\ObservationController::class, 'list'])->name('observation.list');
    Route::get('/client/{client}/observationList', [App\Http\Controllers\ObservationController::class, 'observationList'])->name('observation.observationList');
    Route::resource('disengagement', DisEngagementController::class);
    Route::get('/client/{client}/disengagement', [App\Http\Controllers\DisEngagementController::class, 'create'])->name('disengagement.add');
    Route::resource('planning', PlanningController::class);
    Route::get('/client/{client}/planning', [App\Http\Controllers\PlanningController::class, 'create'])->name('planning.add');
    Route::get('{client}/planning/list', [App\Http\Controllers\PlanningController::class, 'list'])->name('planning.list');
        Route::get('{client}/planning/{planning}/pdf', [App\Http\Controllers\PlanningController::class, 'planningPdf'])->name('planning.planningPdf');
    Route::resource('schedule', ScheduleController::class);
    Route::get('/client/{client}/schedule', [App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.add');
    Route::resource('followup', FollowUpController::class);
    Route::get('/client/{client}/followup', [App\Http\Controllers\FollowUpController::class, 'create'])->name('followup.add');
    Route::get('/client/{client}/followup/list', [App\Http\Controllers\FollowUpController::class, 'list'])->name('followUpList');
    Route::get('/schedule-assessment/list', [App\Http\Controllers\ScheduleController::class, 'list'])->name('schedule.list');
    Route::resource('summary', SummaryController::class);
    Route::get('/client/{client}/summary', [App\Http\Controllers\SummaryController::class, 'create'])->name('summary.add');
    Route::get('/assessment-summary/list', [App\Http\Controllers\SummaryController::class, 'list'])->name('summary.list');
    Route::resource('review', ReviewController::class);
    Route::get('/client/{client}/review', [App\Http\Controllers\ReviewController::class, 'create'])->name('review.add');
    Route::get('/review/list/{client}', [App\Http\Controllers\ReviewController::class, 'list'])->name('review.list');
    Route::get('{client}/review/{review}/pdf', [App\Http\Controllers\ReviewController::class, 'reviewPdf'])->name('review.reviewPdf');
    Route::resource('expense', ExpenseController::class);
    Route::resource('payment', ClientPaymentController::class);
    Route::resource('reports', ReportController::class);
});


Route::get('/invoice', function () {
    $data = [
        'date' => Carbon::now()->format('d-M-Y'),
        'image' =>  url('assets\images\logo.png')
    ];
    $file_name = Str::random(10) . '.pdf';
    $file_path = storage_path('app\public\pdf'.'\planning_'. $file_name);
    $planning=Planning::findOrFail(8);
    $planning->load(['client','plan_types']);

    $start_date = new DateTime($planning->plan_start_date);
    $end_date = new DateTime($planning->plan_end_date);
    $remaining_days = $start_date->diff($end_date)->format('%a');
    $data['remaining_days'] = $remaining_days;
    $data['planning'] = $planning;
    

    $pdf = Pdf::loadView('pdf.planning', $data);
    $path = public_path('/assets/pdf');
     $file = $pdf->output($file_name);
     $file->move($path);
    return 'Hello';
     
});

 
