<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Division\DivisionController;
use App\Http\Controllers\User\UserController;
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

// auth
Route::get('login', [LoginController::class, 'getLogin'])->name('login');
Route::post('login', [LoginController::class,'postLogin'])->name('post.login');
Route::post('check_email_exists', [LoginController::class, 'checkEmailExists']);
Route::get('logout', [LoginController::class,'getLogout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    // user
    Route::get('/search', [UserController::class, 'indexSearch'])->name('user.index.search');
    Route::post('/search', [UserController::class, 'search'])->name('user.search');
    // export file
    Route::get('/export', [UserController::class, 'exportCSV']);

    Route::group(['middleware' => 'clearSessionSearch'], function () {
        // user(some route) and admin
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('user/add', [UserController::class, 'store'])->name('user.store');
        Route::put('user/{id}/edit', [UserController::class, 'update'])->name('user.update');
        Route::delete('user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

        Route::post('user/check_email_unique', [UserController::class, 'checkEmailUnique']);

        // only admin
        Route::group(['middleware' => 'checkPosition0'], function () {
            // division
            Route::get('/division', [DivisionController::class, 'index'])->name('division.index');

            // read file to import
             Route::post('/division/import', [DivisionController::class, 'importCSV'])->name('division.import');

        });
    });
});
