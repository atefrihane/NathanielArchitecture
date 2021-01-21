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

Route::get('/', 'PageController@index');
Route::get('/portfolio', 'PortfolioController@index');
Route::get('/projects/{project}', 'ProjectController@show');
Route::get('/pdf/create', 'PdfController@create');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('/projects', 'ProjectController@index')->name('admin.projects.index');
    Route::get('/projects/{project}/edit', 'ProjectController@edit')->name('admin.projects.edit');
    Route::patch('/projects/{project}', 'ProjectController@update')->name('admin.projects.update');
    Route::post('/projects/{project}', 'ProjectController@store')->name('admin.projects.store');
    Route::post('/projects/{project}/sort', 'ProjectController@sort')->name('admin.projects.sort');
    Route::get('/projects/create', 'ProjectController@create')->name('admin.projects.create.start');
    Route::get('/projects/{project}/create', 'ProjectController@create')->name('admin.projects.create');
    Route::delete('/projects/{project}', 'ProjectController@destroy')->name('admin.projects.destroy');

    Route::get('/photos', 'PhotoController@index')->name('admin.photos.index');
    Route::post('/{project}/photos', 'PhotoController@store')->name('admin.photos.store');
    Route::get('/photos/{photo}', 'PhotoController@edit')->name('admin.photos.edit');
    Route::patch('/photos/{photo}', 'PhotoController@update')->name('admin.photos.update');
    Route::delete('/photos/{photo}', 'PhotoController@destroy')->name('admin.photos.destroy');

    Route::get('/tags', 'TagController@index')->name('admin.tags.index');
    Route::post('/tags', 'TagController@store')->name('admin.tags.store');
    Route::delete('/tags/{tag}', 'TagController@destroy')->name('admin.tags.destroy');

    Route::get('/portfolio', 'PortfolioController@index')->name('admin.portfolio.index');
    Route::post('/portfolio/sort', 'PortfolioController@sort')->name('admin.portfolio.sort');

    Route::get('/slider', 'SliderController@index')->name('admin.slider.index');
    Route::post('/slider/sort', 'SliderController@sort')->name('admin.slider.sort');
});
