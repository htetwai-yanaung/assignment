<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;

Route::redirect('/', '/login');
Route::get('/login', [Controller::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('item')->group(function () {
        Route::get('/index', [ItemController::class, 'index'])->name('item.index');
        Route::get('/create', [ItemController::class, 'create'])->name('item.create');
        Route::post('/store', [ItemController::class, 'store'])->name('item.store');
        Route::get('/delete/{id}', [ItemController::class, 'delete'])->name('item.delete');
        Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
        Route::post('/update/{id}', [ItemController::class, 'update'])->name('item.update');
        route::get('/change/status', [AjaxController::class, 'changeItemStatus']);

    });
    Route::prefix('category')->group(function () {
        route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        route::get('/change/status', [AjaxController::class, 'changeCategoryStatus']);
    });
});

Route::prefix('home')->group(function() {
    Route::get('/index', [HomePageController::class, 'index'])->name('home.index');
    Route::get('/search', [HomePageController::class, 'search'])->name('home.search');
    Route::get('/details/{id}', [HomePageController::class, 'details'])->name('home.details');
    Route::get('/filter', [AjaxController::class, 'filter']);
});
