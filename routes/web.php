<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix' => 'adm', "middleware" => "auth"], function() {
    Route::get('/', IndexController::class)->name('admin.index');
    Route::group(['namespace'=>'Profile', 'prefix' => 'profile'], function() {
        Route::get("/", IndexController::class)->name("admin.profile.index");
    });
    Route::group(['namespace'=>'System', 'prefix' => 'system'], function() {
        Route::group(['namespace'=>'Geo', 'prefix' => 'geo'], function() {
            Route::get("/", IndexController::class)->name("admin.system.geo");
        });
    });
    Route::group(['namespace'=>'User', 'prefix' => 'users'], function() {
        Route::get("/", IndexController::class)->name("admin.user.index");
    });
    Route::group(['namespace'=>'Products', 'prefix' => 'products'], function() {
        Route::get("/", IndexController::class)->name("admin.product.index");
        Route::group(['namespace'=>'Categories', 'prefix' => 'categories'], function() {
            Route::get("/", IndexController::class)->name("admin.product.category.index");
            Route::get("/create", CreateController::class)->name("admin.product.category.create");
            Route::post("/", StoreController::class)->name("admin.product.category.store");
            Route::get("/{category}/edit", EditController::class)->name("admin.product.category.edit");
            Route::get("/{category}", ShowController::class)->name("admin.product.category.show");
            Route::patch("/{category}", UpdateController::class)->name("admin.product.category.update");
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('main.index');
