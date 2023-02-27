<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\StageController;
use App\Http\Controllers\Admin\PipelineController;
use App\Http\Controllers\Admin\CalendarController;
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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'adminauth'], function () {
      Route::get('logout', [LoginController::class, 'adminLogout'])->name('logout');
      Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
     
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::get('roles/add', [RoleController::class, 'create'])->name('add');
    Route::post('roles/store', [RoleController::class, 'store'])->name('store');
    Route::get('roles/edit/{id}', [RoleController::class, 'show'])->name('edit');
    Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('update');
    Route::get('roles/delete', [RoleController::class, 'destroy'])->name('delete');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/add', [UserController::class, 'create'])->name('add');
    Route::post('users/store', [UserController::class, 'store'])->name('store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('update');
    Route::get('users/delete', [UserController::class, 'destroy'])->name('delete');
    Route::post('users/change_password', [UserController::class, 'change_password'])->name('change_password');


    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/add', [ProductController::class, 'create'])->name('add');
    Route::post('products/store', [ProductController::class, 'store'])->name('store');
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('products/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::get('products/delete', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::get('companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('companies/add', [CompanyController::class, 'create'])->name('add');
    Route::post('companies/store', [CompanyController::class, 'store'])->name('store');
    Route::get('companies/edit/{id}', [CompanyController::class, 'edit'])->name('edit');
    Route::post('companies/update/{id}', [CompanyController::class, 'update'])->name('update');
    Route::get('companies/delete', [CompanyController::class, 'destroy'])->name('delete');
    
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('contacts/add', [ContactController::class, 'create'])->name('add');
    Route::post('contacts/store', [ContactController::class, 'store'])->name('store');
    Route::get('contacts/edit/{id}', [ContactController::class, 'edit'])->name('edit');
    Route::post('contacts/update/{id}', [ContactController::class, 'update'])->name('update');
    Route::get('contacts/delete', [ContactController::class, 'destroy'])->name('delete');
    Route::get('contacts/sources', [ContactController::class, 'sources'])->name('sources');
    Route::get('contacts/source_details', [ContactController::class, 'source_details'])->name('source_details');
    Route::post('contacts/store_source', [ContactController::class, 'store_source'])->name('store_source');
    Route::post('contacts/update_source', [ContactController::class, 'update_source'])->name('update_source');
    Route::get('contacts/delete_source', [ContactController::class, 'delete_source'])->name('delete_source');

    Route::get('stages', [StageController::class, 'index'])->name('stages');
    Route::get('stages/details', [StageController::class, 'details'])->name('details');
    Route::post('stages/store', [StageController::class, 'store'])->name('store');
    Route::post('stages/update', [StageController::class, 'update'])->name('update');
    Route::get('stages/delete', [StageController::class, 'delete'])->name('delete');

    Route::get('pipelines', [PipelineController::class, 'index'])->name('pipelines');
    Route::get('pipelines/details', [PipelineController::class, 'details'])->name('details');
    Route::post('pipelines/store', [PipelineController::class, 'store'])->name('store');
    Route::post('pipelines/update', [PipelineController::class, 'update'])->name('update');
    Route::get('pipelines/delete', [PipelineController::class, 'delete'])->name('delete');

    Route::get('deals', [DealController::class, 'index'])->name('deals');
    Route::get('deals/add', [DealController::class, 'create'])->name('add');
    Route::post('deals/store', [DealController::class, 'store'])->name('store');
    Route::get('deals/edit/{id}', [DealController::class, 'edit'])->name('edit');
    Route::post('deals/update/{id}', [DealController::class, 'update'])->name('update');
    Route::get('deals/delete', [DealController::class, 'destroy'])->name('delete');
    Route::get('deals/details/{id}', [DealController::class, 'show'])->name('details');
    Route::get('deals/get_product', [DealController::class, 'get_product'])->name('get_product');
    Route::get('deals/won', [DealController::class, 'won'])->name('won');
    Route::get('deals/lost', [DealController::class, 'lost'])->name('lost');

    Route::get('activities', [ActivityController::class, 'index'])->name('activities');
    Route::get('activities/add', [ActivityController::class, 'create'])->name('add');
    Route::post('activities/store', [ActivityController::class, 'store'])->name('store');
    Route::get('activities/edit/{id}',[ActivityController::class, 'edit'])->name('edit');
    Route::post('activities/update/{id}', [ActivityController::class, 'update'])->name('update');
    Route::get('activities/delete/{id}', [ActivityController::class, 'destroy'])->name('delete');
    Route::get('activities/details/{id}', [ActivityController::class, 'show'])->name('details');

    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
});
