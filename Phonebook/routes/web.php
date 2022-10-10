<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/contacts', [UserController::class, 'contacts'])->name('contacts');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::match(['get','post'],'edit-profile',[UserController::class, 'updateProfile'])->name('edit_profile');
    Route::match(['get','post'],'change-password',[UserController::class, 'changePassword'])->name('change_password');
});

// Route::group(['prefix' => 'admin', 'middleware' => ['EnsureAdminIsValid', 'auth']], function () {
    
// });