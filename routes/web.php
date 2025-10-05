<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminActive;
use App\Http\Middleware\UserActive;
use Illuminate\Support\Facades\Route;


Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'public')->name('public');
    Route::get('/search', 'search')->name('search');
    Route::get('/index', 'index')->middleware(UserActive::class)->name('index');
    Route::get('/file/{uuid}', 'download_count')->name('download_count');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'login_store')->name('login_store');
    Route::get('/login/2fa', 'login_2fa')->name('login_2fa');
    Route::post('/login/2fa', 'login_2fa_store')->name('login_2fa_store');
    Route::get('/logout', 'logout')->middleware(UserActive::class)->name('logout');
});

Route::controller(UserController::class)->middleware(AdminActive::class)->group(function () {
    Route::get('/user', 'index')->name('user');
    Route::get('/user/create', 'create')->name('user_create');
    Route::post('/user/store', 'store')->name('user_store');
    Route::get('/user/edit-{id}', 'edit')->name('user_edit');
    Route::post('/user/update-{id}', 'update')->name('user_update');
    Route::post('/user/delete-{id}', 'delete')->name('user_delete');
});

Route::controller(CategoryController::class)->middleware(AdminActive::class)->group(function () {
    Route::get('/categories', 'index')->name('categories');
    Route::get('/categories/create', 'create')->name('categories_create');
    Route::post('/categories/store', 'store')->name('categories_store');
    Route::get('/categories/edit-{id}', 'edit')->name('categories_edit');
    Route::post('/categories/update-{id}', 'update')->name('categories_update');
    Route::get('/categories/show-{id}', 'show')->name('categories_show');
    Route::post('/categories/delete-{id}', 'delete')->name('categories_delete');

    Route::post('/categories/upload/{id}', 'upload')->name('categories_upload');
    Route::post('/categories/document_delete/{id}', 'document_delete')->name('categories_document_delete');
});

Route::controller(DocumentController::class)->middleware(AdminActive::class)->group(function () {
    Route::get('/documents', 'index')->name('documents');
    Route::get('/documents/create', 'create')->name('documents_create');
    Route::post('/documents/store', 'store')->name('documents_store');
    Route::get('/documents/edit-{id}', 'edit')->name('documents_edit');
    Route::post('/documents/update-{id}', 'update')->name('documents_update');
    Route::post('/documents/delete-{id}', 'delete')->name('documents_delete');
});

Route::controller(DepartmentController::class)->middleware(AdminActive::class)->group(function () {
    Route::get('/departments', 'index')->name('departments');
    Route::get('/departments/create', 'create')->name('departments_create');
    Route::post('/departments/store', 'store')->name('departments_store');
    Route::get('/departments/edit-{id}', 'edit')->name('departments_edit');
    Route::post('/departments/update-{id}', 'update')->name('departments_update');
    Route::post('/departments/delete-{id}', 'delete')->name('departments_delete');
});

Route::controller(SlideController::class)->middleware(AdminActive::class)->group(function () {
    Route::get('/slides', 'index')->name('slides');
    Route::get('/slides/create', 'create')->name('slides_create');
    Route::post('/slides/store', 'store')->name('slides_store');
    Route::get('/slides/edit-{id}', 'edit')->name('slides_edit');
    Route::post('/slides/update-{id}', 'update')->name('slides_update');
    Route::post('/slides/delete-{id}', 'delete')->name('slides_delete');

    Route::get('/slides/order', 'order')->name('slides_order');
    Route::post('/slides/order/update', 'order_update')->name('slides_order_update');
});
