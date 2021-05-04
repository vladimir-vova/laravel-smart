<?php

use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TaskController;
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
    // регистрация
    Route::get('/register', [UserController::class, 'create'])->name('create');
    Route::post('/register', [UserController::class, 'store'])->name('create.users');

    // авторизация
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    // изменение пароля
    Route::get('/password', [UserController::class, 'passwordForm'])->name('password.create');
    Route::put('/password', [UserController::class, 'password'])->name('password');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // contact
    Route::get('/contact', [AdminMainController::class, 'contactForm'])->name('contact.create');
    Route::post('/contact', [AdminMainController::class, 'contact'])->name('contact');

    // profile
    Route::get('/profile', [AdminMainController::class, 'profile'])->name('profile.index');
    Route::put('/profile/data', [AdminMainController::class, 'profileData'])->name('profile.data');
    Route::put('/profile/password', [AdminMainController::class, 'profilePassword'])->name('profile.password');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/works/{way}/{name}/{step}', [AdminMainController::class, 'step'])->name('works.step');

    // message
    Route::get('/message', [AdminMainController::class, 'message'])->name('message.index');
    Route::get('/message/{message}', [AdminMainController::class, 'messageShow'])->name('message.show');
    Route::delete('/message/{message}', [AdminMainController::class, 'messageDestroy'])->name('message.destroy');

    // profile
    Route::get('/profile', [AdminMainController::class, 'profile'])->name('profile.index');
    Route::put('/profile/data', [AdminMainController::class, 'profileData'])->name('profile.data');
    Route::put('/profile/password', [AdminMainController::class, 'profilePassword'])->name('profile.password');

    // c ресурсами
    Route::resource('/users', AdminUserController::class);
    Route::resource('/status', StatusController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/works', WorkController::class);
    Route::resource('/tasks', TaskController::class);
    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/tags', TagController::class);
    // Route::resource('/posts', PostController::class);
});


// Route::post('/', [MainController::class, 'store'])->name('create.users');