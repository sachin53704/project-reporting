<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LogindController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/theme/login', [DashboardController::class, 'login']);
Route::get('/', function(){
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/theme/form', [DashboardController::class, 'form']);
    Route::get('/theme/table', [DashboardController::class, 'table']);
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route::get('demo', )

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
