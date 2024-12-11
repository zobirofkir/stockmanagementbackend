<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * User Management
 */
Route::apiResource('users', UserController::class);

/**
 * Category Management
 */
Route::apiResource('categories', CategoryController::class);

/**
 * Supplier Management
 */
Route::apiResource('suppliers', SupplierController::class);


/**
 * Product Management
 */
Route::apiResource('products', ProductController::class);
