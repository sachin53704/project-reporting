<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LogindController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\TaskController;

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
    Route::get('/admin/master/role/list', [RoleController::class, 'list'])->name('roles.list');
    Route::get('/admin/master/role/add', [RoleController::class, 'add'])->name('role.add');
    Route::post('/admin/master/role/store', [RoleController::class, 'store']);
    Route::get('/admin/master/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/admin/master/role/update', [RoleController::class, 'update']);

    // Manage Permission Master
    Route::get('/admin/master/permission/list', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('/admin/master/permission/add', [PermissionController::class, 'add'])->name('permission.add');
    Route::post('/admin/master/permission/store', [PermissionController::class, 'store']);
    Route::get('/admin/master/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/admin/master/permission/update', [PermissionController::class, 'update']);
    Route::post('/admin/master/permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');

    // Route for change password
    Route::get('/admin/change-password/', [ChangePasswordController::class, 'changePassword'])->name('admin.change-password');
    Route::post('/admin/change-password/', [ChangePasswordController::class, 'updateChangePassword'])->name('admin.save.change-password');

    // Route for user
    Route::get('/admin/user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('/admin/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user/update', [UserController::class, 'update']);

    // Route for project
    Route::get('/admin/master/project/list', [ProjectController::class, 'list']);
    Route::get('/admin/master/project/add', [ProjectController::class, 'add']);
    Route::post('/admin/master/project/store', [ProjectController::class, 'store']);
    Route::get('/admin/master/project/edit/{id}', [ProjectController::class, 'edit']);
    Route::post('/admin/master/project/update', [ProjectController::class, 'update']);

    // Route for project type
    Route::get('/admin/master/project-type/list', [ProjectTypeController::class, 'list']);
    Route::get('/admin/master/project-type/add', [ProjectTypeController::class, 'add']);
    Route::post('/admin/master/project-type/store', [ProjectTypeController::class, 'store']);
    Route::get('/admin/master/project-type/edit/{id}', [ProjectTypeController::class, 'edit']);
    Route::post('/admin/master/project-type/update', [ProjectTypeController::class, 'update']);

    // Route for tasks
    Route::get('/admin/task/list', [TaskController::class, 'list']);
    Route::get('/admin/task/add', [TaskController::class, 'add']);
    Route::post('/admin/task/store', [TaskController::class, 'store']);
    Route::get('/admin/task/edit/{id}', [TaskController::class, 'edit']);
    Route::post('/admin/task/update', [TaskController::class, 'update']);
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route::get('demo', )

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
