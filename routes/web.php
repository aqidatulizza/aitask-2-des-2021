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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//->middleware('auth');
Route::middleware(['auth'])->group(function() {
    Route::resource('companies', 'CompaniesController');
    Route::post('companies/adduser', 'CompaniesController@adduser')->name('companies.adduser');

    Route::resource('projects', 'ProjectsController');
    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');

    Route::resource('roles', 'RolesController');

    Route::resource('tasks', 'TasksController');
    Route::post('tasks/adduser', 'TasksController@adduser')->name('tasks.adduser');
    Route::get('tasks/create/{project_id?}', 'TasksController@create');

    Route::resource('users', 'UsersController');
    Route::resource('comments', 'CommentsController');

    Route::resource('companyusers', 'CompanyUsersController');

    Route::resource('itemchecklists', 'ItemChecklistsController');
});
