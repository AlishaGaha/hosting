<?php

use Illuminate\Support\Facades\Route;

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
// Route::get('/plans', 'PlanController@index')->name('plans');
// Route::get('/plans/create', 'PlanController@create')->name('plans.create');
// Route::post('/plans', 'PlanController@store')->name('plans.store');
// Route::get('/plans/{slug}/edit', 'PlanController@edit')->name('plans.edit');
// Route::put('/plans/{slug}', 'PlanController@update')->name('plans.update');
// Route::delete('/plans/{slug}', 'PlanController@destroy')->name('plans.destroy');
Route::group(['middleware' => 'auth' ], function () {
    Route::resource('users', 'UserController');
    Route::resource('plans', 'PlanController')->except([
        'show'
    ]);
    Route::resource('clients', 'ClientController')->except([
        'show',
        'destroy'
    ]);

    Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
    Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
    Route::put('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
    Route::resource('posts', 'PostsController');
    Route::resource('categories', 'CategoriesController');
});
Route::resource('hosting-renewal', 'HostingRenewalController')->except([
    'show'
]);
Route::resource('domain-renewal', 'DomainRenewalController')->except([
    'show'
]);
Route::resource('blogs', 'BlogController')->except([
    'show'
]);

// Route::get('/clients', 'ClientController@index')->name('clients.index');
// Route::get('/clients/create', 'ClientController@create')->name('clients.create');
// Route::post('/clients', 'ClientController@store')->name('clients.store');
// Route::get('/clients/{id}/edit', 'ClientController@edit')->name('clients.edit');
// Route::put('/clients/{id}', 'ClientController@update')->name('clients.update');
