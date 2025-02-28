<?php

use App\Http\Controllers\Admin\{
    DashbaordController,
    DomaineValeurController,
    DomaineValeurElementController,
    IntervenantController,
    ObjectifController,
    ObjectController,
    PerformanceController,
    PlanificationController
};
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.login');
})->name('/');

Route::get('/login', [AuthController::class, 'go_to_login'])->name('login');
Route::post('/doLogin', [AuthController::class, 'login'])->name('doLogin');

Route::middleware(['auth'])->group(function () {
    // Resources
    Route::resource('dashboard', DashbaordController::class);
    Route::resource('domaine', DomaineValeurController::class);
    Route::resource('domaineElement', DomaineValeurElementController::class);
    Route::resource('intervenants', IntervenantController::class);
    Route::resource('objectifs', ObjectifController::class);
    Route::resource('Objects', ObjectController::class);
    Route::resource('performances', PerformanceController::class);
    Route::resource('planification', PlanificationController::class);
    Route::resource('users', UsersController::class);

    // Routes de performance
    Route::controller(PerformanceController::class)->group(function () {
        Route::post('intervenant_activites', 'intervenant_activites')->name('intervenant_activites');
        Route::get('get_activite_for_single_intervenant/{id}', 'get_activite_for_single_intervenant')->name('get_activite_for_single_intervenant');
        Route::get('get_objectifi_activities/{id}', 'get_objectifi_activities')->name('get_objectifi_activities');
        Route::get('get_activitites_domaine_valeurs/{id}', 'get_activitites_domaine_valeurs')->name('get_activitites_domaine_valeurs');
        Route::get('get_objection_value/{id}', 'get_objection_value')->name('get_objection_value');
        Route::post('intervenant_activites_detach', 'intervenant_activites_detach')->name('intervenant_activites_detach');
        Route::post('store_performance_intervenants', 'store_performance_intervenants')->name('store_performance_intervenants');
        Route::get('/performances_all', 'get_peformance_user_folders')->name('performances.all');
    });

    // Routes du tableau de bord
    Route::get('/get_peformance_user_chart', [DashbaordController::class, 'get_peformance_user_chart'])->name('get_peformance_user_chart');

    // Routes d'authentification et profil
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/profile', 'go_and_edit_profile')->name('go_and_edit_profile');
    });

    // Routes utilisateur
    Route::post('/update_theme', [UsersController::class, 'update_theme'])->name('update_theme');
    Route::post('/updatePassword', [UsersController::class, 'updatePassword'])->name('updatePassword');
});
