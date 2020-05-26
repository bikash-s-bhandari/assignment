<?php

Route::get('/', function () {
    return redirect()->route('admin_home');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'authorized_users']], function () {
    Route::get('/', ['as' => 'admin_home', 'uses' => 'AdminController@index']);
   //both admin  and user can create product
    Route::resource('product', 'ProductController');

    Route::group(['middleware' => 'role', 'roles' => ['admin']], function () {
        // routes only admin can view and delete user
        Route::resource('user', 'UserController', ['except' => ['create', 'edit', 'update']]);

    });

});

Auth::routes();
