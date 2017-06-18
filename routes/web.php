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

Route::group(['namespace' => config('route.ns.front')], function() {
  Route::get('/', ['as' => 'root', 'uses' => 'HomeController@index']);
  Route::get('all/{categoryLvl1?}/{categoryLvl2?}/{categoryLvl3?}', ['as' => 'product.index', 'uses' => 'ProductController@index']);
  Route::get('s/{argument1}/{argument2?}/{argument3?}/{argument4?}', ['as' => 'product.show', 'uses' => 'ProductController@show']);
  Route::group(['prefix' => config('route.fr.order')], function() {
    Route::get('shopping-cart', ['as' => 'order.shopping-cart', 'uses' => 'OrderController@shoppingCart']);
    Route::group(['prefix' => 'c'], function() {
      Route::get('step-1', ['as' => 'order.step-1', 'uses' => 'OrderController@step1']);
      Route::post('step-1', ['as' => 'order.step-1', 'uses' => 'OrderController@storeStep1']);
      Route::get('step-2', ['as' => 'order.step-2', 'uses' => 'OrderController@step2']);
      Route::post('step-2', ['as' => 'order.step-2', 'uses' => 'OrderController@storeStep2']);
      Route::get('step-3', ['as' => 'order.step-3', 'uses' => 'OrderController@Step3']);
      Route::post('step-3', ['as' => 'order.step-3', 'uses' => 'OrderController@storeStep3']);
      Route::get('step-4', ['as' => 'order.step-4', 'uses' => 'OrderController@step4']);
      Route::post('save', ['as' => 'order.save', 'uses' => 'OrderController@save']);
      Route::get('finish/{orderId}', ['as' => 'order.success', 'uses' => 'OrderController@finish']);
    });
  });
  Route::group(['prefix' => config('route.fr.ajax')], function() {
    Route::get('highlight-product/{type}', 'ProductController@ajaxRequest');
  });
  Route::group(['prefix' => config('route.fr.ajax')], function() {
    Route::get('product/category/{name}', ['as' => 'product.category', 'uses' => 'ProductController@ajaxRequest']);
    Route::resource('cart', 'CartController', ['except' => ['edit', 'create']]);
  });
  Route::group(['prefix' => config('route.fr.register')], function() {
    Route::get('register', ['as' => 'member.register', 'uses' => 'MemberController@register']);
    Route::post('register', ['as' => 'member.register', 'uses' => 'MemberController@saveRegister']);
    Route::get('success-register/{hashId?}', ['as' => 'member.success-register', 'uses' => 'MemberController@successRegister']);
  });
});

Route::group(['namespace' => config('route.ns.master')], function() {
  Route::group(['prefix' => config('route.fr.ajax')], function() {
    Route::get('country', 'CountryController@ajaxRequest');
    Route::get('category', 'CategoryController@ajaxRequest');
  });
});
