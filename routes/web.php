<?php

use App\Http\Controllers\Admin\{
    DashbaordController,
    DomaineValeurController,
    DomaineValeurElementController,
    EntitesController,
    EtatsController,
    FichePostController,
    IntervenantController,
    ObjectifController,
    ObjectController,
    PerformanceController,
    PlanificationController,
    PostWorController,
    PresencesController,
    TypeControllerController
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
    Route::resource('entity', EntitesController::class);
    Route::resource('type_entity', TypeControllerController::class);
    Route::resource('presences', PresencesController::class);
    Route::resource('etats', EtatsController::class);
    Route::resource('postWork', PostWorController::class);
    Route::resource('post_travail', FichePostController::class);

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

    Route::get('/get_peformance_user_chart', [DashbaordController::class, 'get_peformance_user_chart'])->name('get_peformance_user_chart');
    Route::get('/load_entity_for_js', [EntitesController::class, 'load_entity_for_js'])->name('load_entity_for_js');
    Route::get('/get_type_entity_api', [EntitesController::class, 'get_type_entity_api'])->name('get_type_entity_api');
    Route::post('/store_subentity', [EntitesController::class, 'store_subentity'])->name('store_subentity');
    Route::delete('/destroy_entity/{id}', [TypeControllerController::class, 'destroy_entity'])->name('destroy_entity');
    Route::get('/add_post_work/{id}', [EntitesController::class, 'go_to_view_add_post_job'])->name('go_to_view_add_post_job');
    // Route::post('/store_fiche', [FichePostController::class, 'store_fiche'])->name('store_fiche');

    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/profile', 'go_and_edit_profile')->name('go_and_edit_profile');
    });

    Route::post('/update_theme', [UsersController::class, 'update_theme'])->name('update_theme');
    Route::post('/updatePassword', [UsersController::class, 'updatePassword'])->name('updatePassword');
});
