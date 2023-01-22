<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/about-us', [MainController::class, 'about'])->name('about');

Route::get('/contact-us', [MessageController::class, 'show'])->name('contact');
Route::post('/contact-us', [MessageController::class, 'store'])->name('contact_store');

Route::group(['prefix' => '/hotels', 'as' => 'hotels.', 'middleware' => 'auth'], function () {
    Route::get('/add', [HotelController::class, 'addHotel'])->name('add.hotel');

    Route::post('/add', [HotelController::class, 'add'])->name('add');
    Route::get('', [HotelController::class, 'list'])->name('list');
    Route::group(['prefix' => '/{hotel}/edit'], function () {
        Route::get('', [HotelController::class, 'editHotel'])->name('edit.hotel');
        Route::post('', [HotelController::class, 'edit'])->name('edit');
    });
    Route::get('/{hotel}', [HotelController::class, 'show'])->name('show');
    Route::post('/{hotel}/delete', [HotelController::class, 'delete'])->name('delete');
});

Route::get('/sign-up', [UserController::class, 'signUpForm'])->name('sign-up.form');
Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign-up');

Route::get('/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])->name('verify.email');

Route::get('/sign-in', [AuthController::class, 'signInForm'])->name('login');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
