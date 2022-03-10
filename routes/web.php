<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListAssessmentsController;
use App\Http\Controllers\OverallController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

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
})->name("starterPage");
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//Route::get('/test', [HistoryController::class, 'test'])->name('test');

#Protected routes
Route::middleware(['checkStatus'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('division')->name('division.')->group(function () {
        Route::get('/', [DivisionController::class, 'index'])->name('index');
        Route::get('/create', [DivisionController::class, 'create'])->name('create');
        Route::post('/store', [DivisionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DivisionController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [DivisionController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [DivisionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [EmployeeController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [EmployeeController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/reset-password', [EmployeeController::class, 'resetPassword'])->name('reset-password');
    });


    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category_detail')->name('category_detail.')->group(function () {
        Route::get('/', [CategoryDetailController::class, 'index'])->name('index');
        Route::get('/create', [CategoryDetailController::class, 'create'])->name('create');
        Route::post('/store', [CategoryDetailController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryDetailController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [CategoryDetailController::class, 'update'])->name('update');
        Route::post('/{id}/destroy', [CategoryDetailController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('list_assessment')->name('list_assessment.')->group(function () {
        Route::get('/', [ListAssessmentsController::class, 'index'])->name('index');
        Route::get('/create', [ListAssessmentsController::class, 'create'])->name('create');
        Route::post('/store', [ListAssessmentsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ListAssessmentsController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ListAssessmentsController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [ListAssessmentsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('overall')->name('overall.')->group(function () {
        Route::get('/', [OverallController::class, 'index'])->name('index');
        Route::get('/test/{userId}/{testId}', [OverallController::class, 'test'])->name('test');
        Route::get('/getTestByCategory/{categoryId}/{testId}/{userId}', [OverallController::class, 'testByCategory'])->name('testByCategory');
        Route::post('/processTest', [OverallController::class, 'processTest'])->name('processTest');

    });

    Route::prefix('history')->name('history.')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('index');
        Route::get('/{userId}',[HistoryController::class, 'listTest'])->name('listTest');
        Route::get('/test/result/{userId}/{testId}',[HistoryController::class, 'generateHistory'])->name('generateHistory');
        Route::get('/pdf/result/{userId}/{testId}',[HistoryController::class,'generatePdf'])->name('generatePdf');

    });


    Route::prefix('general')->name('general.')->group(function () {
        Route::get('/{userId}/{testId}/{history?}', [OverallController::class, 'getForm'])->name('getForm');
    });



});

