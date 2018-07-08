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

Route::group(['middleware' => 'web'], function () {

    Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute', 'as' => 'home']);
    Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);

    Auth::routes();

});

//admin/service
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //admin/
    Route::get('/', function () {

    });


   //admin/pages
   Route::group(['prefix' => 'pages'], function () {

       //admin/pages
       Route::get('/', ['uses' => 'PageController@execute', 'as' => 'pages']);

       //admin/pages/add
       Route::match(['get','post'], 'add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);

       //admin/pages/edit/{page}
       Route::match(['get', 'post', 'delete'], 'edit/{page}', ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);

   });


    //admin/portfolio
    Route::group(['prefix' => 'portfolios'], function () {

        //admin/portfolio
        Route::get('/', ['uses' => 'PortfolioController@execute', 'as' => 'portfolio']);
        //admin/portfolio/add
        Route::match(['get','post'], 'add', ['uses' => 'PortfolioAddController@execute', 'as' => 'portfolioAdd']);
        //admin/portfolio/edit/{page}
        Route::match(['get', 'post', 'delete'], 'edit/{portfolio}', ['uses' => 'PortfolioEditController@execute', 'as' => 'portfolioEdit']);

    });


    //admin/service
    Route::group(['prefix' => 'services'], function () {

        //admin/services
        Route::get('/', ['uses' => 'ServiceController@execute', 'as' => 'services']);
        //admin/services/add
        Route::match(['get','post'], 'add', ['uses' => 'ServiceAddController@execute', 'as' => 'servicesAdd']);
        //admin/services/edit/{page}
        Route::match(['get', 'post', 'delete'], 'edit/{services}', ['uses' => 'ServiceEditController@execute', 'as' => 'servicesEdit']);

    });


});
