<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Layout.main-layout');
});


Route::resource('domaine', 'App\Http\Controllers\Admin\DomaineValeurController');
Route::resource('domaineElement', 'App\Http\Controllers\Admin\DomaineValeurElementController');
Route::resource('intervenants', 'App\Http\Controllers\Admin\IntervenantController');
Route::resource('objectifs', 'App\Http\Controllers\Admin\ObjectifController');
Route::resource('Objects', 'App\Http\Controllers\Admin\ObjectController');
Route::resource('performances', 'App\Http\Controllers\Admin\PerformanceController');
Route::resource('planification', 'App\Http\Controllers\Admin\PlanificationController');
//Route::resource('days', 'App\Http\Controllers\Admin\DayController');
Route::post('intervenant_activites', [App\Http\Controllers\Admin\PerformanceController::class,'intervenant_activites'])->name('intervenant_activites');
Route::get('get_activite_for_single_intervenant/{id}', [App\Http\Controllers\Admin\PerformanceController::class,'get_activite_for_single_intervenant'])->name('get_activite_for_single_intervenant');
Route::get('get_objectifi_activities/{id}', [App\Http\Controllers\Admin\PerformanceController::class,'get_objectifi_activities'])->name('get_objectifi_activities');
Route::get('get_activitites_domaine_valeurs/{id}', [App\Http\Controllers\Admin\PerformanceController::class,'get_activitites_domaine_valeurs'])->name('get_activitites_domaine_valeurs');
Route::get('get_objection_value/{id}', [App\Http\Controllers\Admin\PerformanceController::class,'get_objection_value'])->name('get_objection_value');
Route::post('intervenant_activites_detach', [App\Http\Controllers\Admin\PerformanceController::class,'intervenant_activites_detach'])->name('intervenant_activites_detach');
Route::post('store_performance_intervenants', [App\Http\Controllers\Admin\PerformanceController::class,'store_performance_intervenants'])->name('store_performance_intervenants');
Route::get('/performances_all', [App\Http\Controllers\Admin\PerformanceController::class, 'get_peformance_user_folders'])->name('performances.all');
