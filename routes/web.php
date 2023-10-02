<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LogindController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\UserController;

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
    // route for dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    // dummy route for theme
    Route::get('/dashboard/demo', [DashboardController::class, 'dashboard']);
    Route::get('/theme/form', [DashboardController::class, 'form']);
    Route::get('/theme/table', [DashboardController::class, 'table']);

    // Manage Role Master
    Route::get('/master/roles', [RoleController::class, 'list'])->name('roles.list');
    Route::get('/master/roles/add', [RoleController::class, 'add'])->name('role.add');
    Route::post('/master/roles/store', [RoleController::class, 'store']);
    Route::get('/master/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/master/roles/update', [RoleController::class, 'update']);

    // Manage Permission Master
    Route::get('/master/permissions', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('/master/permissions/add', [PermissionController::class, 'add'])->name('permission.add');
    Route::post('/master/permissions/store', [PermissionController::class, 'store']);
    Route::get('/master/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/master/permissions/update', [PermissionController::class, 'update']);
    Route::post('/master/permissions/delete', [PermissionController::class, 'delete'])->name('permission.delete');

    // Route for change password
    Route::get('/admin/change-password/', [ChangePasswordController::class, 'changePassword'])->name('admin.change-password');
    Route::post('/admin/change-password/', [ChangePasswordController::class, 'updateChangePassword'])->name('admin.save.change-password');

    // Route for user
    Route::get('/admin/user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('/admin/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user/update', [UserController::class, 'update']);
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route::get('demo', )

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
