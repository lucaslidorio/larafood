<?php

//Todas as Rotas que possui o prefixo admin
Route::prefix('admin')
                    ->namespace('Admin')//namespace antes  co controler ex: Admin\PlanController@create
                    ->middleware('auth')
                    ->group(function () {


    /*
    Rotas Produtos
    */
    Route::any('tables/search', 'TableController@search')->name('tables.search');
    Route::resource('tables', 'TableController');
    



     /*
    Produtos x Categorias
    */
    Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoriesProduct')->name('products.categories.detach');  
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');  
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');
            
    /*
    Rotas Produtos
    */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');
    

    /*
    Rotas Categorias
    */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');
    

     /*
    Rotas Tenants
    */
    Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
    Route::resource('tenants', 'TenantController');
    

    /*
    Rotas Users
    */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');
    

     /*
    Plans x Profiles
    */
    Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')->name('plans.profiles.detach');  
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');  
    Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');


    /*
    Rotas Permissões perfil
    */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');  
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
 
    /*
    Rotas Perfis Permissoões perfil
    */
    Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
 
     
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
    
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy'); 
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
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

    Route::get('/ ', 'PlanController@index')->name('admin.index');
});

//rota do site publico
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

//Rotas de autenticação
Auth::routes();

