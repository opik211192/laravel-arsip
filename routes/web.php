<?php

use App\Http\Controllers\Arsip\ArsipController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JenisController;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\UserController;
use App\Http\Controllers\Permissions\AssignController;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\UnitController;

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

Route::get('/register/user', [RegisterController::class, 'index'])->name('register.index');
Route::get('register/edit/{user}', [RegisterController::class, 'edit'])->name('register.edit');
Route::patch('/register/{user}', [RegisterController::class, 'update'])->name('register.update');
Route::delete('/register/{user}', [RegisterController::class, 'delete'])->name('register.delete');

Route::middleware('has.role')->prefix('xyz')->group(function(){
    Route::view('dashboard', 'dashboard')->name('dashboard');

    //Route untuk arsip
    Route::prefix('arsip')->group(function(){
        Route::get('', [ArsipController::class, 'index'])->name('arsip.index');
        Route::post('', [ArsipController::class, 'store'])->name('arsip.store');
        Route::get('/data', [ArsipController::class, 'data'])->name('arsip.data');
        Route::get('/data/{arsip}/detail', [ArsipController::class, 'detail'])->name('arsip.detail');
        Route::get('/data/{arsip}/download', [ArsipController::class, 'download'])->name('arsip.download');
        Route::get('/edit/{arsip}', [ArsipController::class, 'edit'])->name('arsip.edit');
        Route::put('edit/{arsip}', [ArsipController::class, 'update']);
        Route::delete('/data/{arsip}', [ArsipController::class, 'destroy'])->name('arsip.delete');
    });

    //Route untuk setting jenis arsip
    Route::prefix('setting-jenis-arsip')->group(function(){
        route::get('', [JenisController::class, 'index'])->name('jenis.index');
        Route::post('/create', [JenisController::class, 'store'])->name('jenis.create');
        Route::get('/{jenis}/edit', [JenisController::class, 'edit'])->name('jenis.edit');
        Route::put('{jenis}/edit', [JenisController::class, 'update']);
        Route::delete('/{jenis}', [JenisController::class, 'delete'])->name('jenis.delete');
    });

    //Route untuk setting Unit user
    Route::prefix('setting-unit-user')->group(function(){
        route::get('', [UnitController::class, 'index'])->name('unit.index');
        Route::post('/create', [UnitController::class, 'store'])->name('unit.create');
        Route::get('/{unit}/edit', [UnitController::class, 'edit'])->name('unit.edit');
        Route::put('{unit}/edit', [UnitController::class, 'update']);
        Route::delete('/{unit}', [UnitController::class, 'delete'])->name('unit.delete');
    });

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
