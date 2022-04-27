<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\UserController;
use App\Http\Controllers\Permissions\AssignController;
use App\Http\Controllers\Permissions\PermissionController;


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
});

Auth::routes();


Route::middleware('has.role')->prefix('xyz')->group(function(){
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('role-and-permission')->namespace('Permissions')->middleware('permission:assign permission')->group(function(){
        
        //Route untuk Assign Permission
        Route::get('assignable', [AssignController::class, 'create'])->name('assign.create');
        Route::post('assignable', [AssignController::class, 'store']);
        Route::get('assignable/{role}/edit', [AssignController::class, 'edit'])->name('assign.edit');
        Route::put('assignable/{role}/edit', [AssignController::class, 'update']);


        //Route untuk user
        Route::get('assign/user', [UserController::class, 'create'])->name('assign.user.create');
        Route::post('assign/user', [UserController::class, 'store']);
        Route::get('assign/{user}/user', [UserController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign/{user}/user', [UserController::class, 'update']);


        //Route untuk Roles
        Route::prefix('roles')->group(function(){
            Route::get('', [RoleController::class, 'index'])->name('roles.index');
            Route::post('/create', [RoleController::class, 'store'])->name('roles.create');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{role}/edit', [RoleController::class, 'update']);
            Route::delete('/{role}', [RoleController::class, 'delete'])->name('roles.delete');         
        });

        //Route untuk Permissions
        Route::prefix('permissions')->group(function(){
            Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
            Route::post('/create', [PermissionController::class, 'store'])->name('permissions.create');
            Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::put('/{permission}/edit', [PermissionController::class, 'update']);
            Route::delete('/{permission}', [PermissionController::class, 'delete'])->name('permissions.delete');         
        });

    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
