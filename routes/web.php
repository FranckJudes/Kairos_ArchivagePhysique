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
