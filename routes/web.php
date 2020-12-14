<?php

//Todas as Rotas que possui o prefixo admin
Route::prefix('admin')
                    ->namespace('Admin')//namespace antes  co controler ex: Admin\PlanController@create
                    ->group(function () {

    
     
     /*
    Rotas Permissões
    */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');
    

    /*
    Rotas Perfis
    */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');
    

    /*
    Rotas Detalhes Planos
    */
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy'); 
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show'); 
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');                    
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');


    /*
    Rotas Planos
    */

    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    
    /*
    Rotas Home Dashboard
    */

    Route::get('/ ', 'Admin\PlanController@index')->name('admin.index');
});

Route::get('/', function () {
    return view('welcome');
});
