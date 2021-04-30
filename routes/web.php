<?php

use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'index'])->name('index');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('create');
    Route::post('/register', [UserController::class, 'store'])->name('create.users');

    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('/users', AdminUserController::class);
    Route::resource('/status', StatusController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/works', WorkController::class);
    Route::get('/works/{way}/{name}/{step}', [AdminMainController::class, 'step'])->name('works.step');
    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/tags', TagController::class);
    // Route::resource('/posts', PostController::class);
});


// Route::post('/', [MainController::class, 'store'])->name('create.users');