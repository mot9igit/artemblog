<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('{page}', [App\Http\Controllers\IndexController::class, '__invoke'])->where("page", ".*");
