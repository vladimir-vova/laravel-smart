<?php

use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TypeController;
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
Route::post('/', [MainController::class, 'contact'])->name( 'contact');
Route::get('/spasibo', [MainController::class, 'spasibo'])->name('spasibo');

// Medic
Route::get('/medic', [MainController::class, 'medic'])->name('medic');
// Tort
Route::get('/tort', [MainController::class, 'tort'])->name('tort');
Route::get('/tort/svyas', [MainController::class, 'svyas'])->name('tort.svyas');
// Remont
Route::get('/remont', [MainController::class, 'remont'])->name('remont');

Route::group(['middleware' => 'guest'], function () {
    // Route::get('/orders', [MainController::class, 'orders'])->name('orders.quit');
    // Route::post('/', [MainController::class, 'contact'])->name('contact.message');

    // регистрация
    // Route::get('/register', [UserController::class, 'create'])->name('create');
    // Route::post('/register', [UserController::class, 'store'])->name('create.users');

    // авторизация
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    // изменение пароля
    Route::get('/password', [UserController::class, 'passwordForm'])->name('password.create');
    Route::put('/password', [UserController::class, 'password'])->name('password');
});
// Route::get('/admin', [AdminMainController::class, 'index'])->name('admin.index');
// Route::get('/admin/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', ['middleware' => ['auth','admin']]], function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // note
    Route::get('/note', [AdminMainController::class, 'note'])->name('note.index');
    Route::post('/note/update', [AdminMainController::class, 'noteUpdate'])->name('note.update');
    Route::post('/note/delete', [AdminMainController::class, 'noteDelete'])->name('note.delete');
    // Route::get('/note/{note}', [AdminMainController::class, 'noteUpdate'])->name('note.update');

    // order
    Route::post('/order/update', [OrderController::class, 'orderUpdate'])->name('order.update');
    Route::post('/order/delete', [OrderController::class, 'orderDelete'])->name('order.delete');
    Route::post('/order/wayOpen', [OrderController::class, 'wayOpen'])->name('orders.wayopen');
    Route::resource('/orders', OrderController::class);
    Route::get('/closeorders', [OrderController::class, 'showClose'])->name('orders.closeorders');
    Route::get('/search/orders', [SearchController::class, 'orders'])->name('search.orders');
    Route::get('/search/ordersclose', [SearchController::class, 'ordersclose'])->name('search.ordersclose');
    // Route::post('/closeorders/{order}', [OrderController::class, 'wayClose'])->name('orders.wayclose');

    // profile
    Route::get('/profile', [AdminMainController::class, 'profile'])->name('profile.index');
    Route::put('/profile/data', [AdminMainController::class, 'profileData'])->name('profile.data');
    Route::put('/profile/password', [AdminMainController::class, 'profilePassword'])->name('profile.password');

    // task
    Route::get('/search/taskclose', [SearchController::class, 'taskclose'])->name('search.taskclose');
    Route::get('/closetasks', [TaskController::class, 'showClose'])->name('tasks.closetasks');
    Route::get('/rules', [TaskController::class, 'rules'])->name('rules');
    Route::put('/updateToClose/{task}', [TaskController::class, 'updateToClose'])->name('updateToClose');
    Route::resource('/tasks', TaskController::class);
    
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    // users
    Route::get('/search/users', [SearchController::class, 'users'])->name('search.users');
    Route::resource('/users', AdminUserController::class);

    // status
    Route::get('/status/add', [StatusController::class, 'add'])->name('add.status');
    Route::resource('/status', StatusController::class);

    // works
    Route::get('/works/{way}/{name}/{step}', [AdminMainController::class, 'step'])->name('works.step');
    Route::get('/works/add', [WorkController::class, 'add'])->name('add.works');
    Route::resource('/works', WorkController::class);
    // // Route::get('/works/add', [WorkController::class, 'add'])->name('add.works');
    // Route::get('/works/{way}/{name}/{step}', [AdminMainController::class, 'step'])->name('works.step');

    // types
    Route::get('/types/add', [TypeController::class, 'add'])->name('add.types');
    Route::resource('/types', TypeController::class);
    // Route::get('/types/add', [TypeController::class, 'add'])->name('add.types');

});