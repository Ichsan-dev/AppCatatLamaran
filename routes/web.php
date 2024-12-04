<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\LoginCotroller;
use App\Http\Controllers\ResetPassword;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginCotroller::class,'index'])->name('login');
Route::post('/login-Proses', [LoginCotroller::class,'login'])->name('loginproses');

Route::middleware('auth')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
Route::get('/logout', [LoginCotroller::class, 'logout'])->name('logout');

Route::get('/companies', [CompanyController::class,'index'])->name('Company');
Route::post('/companies-proses', [CompanyController::class,'store'])->name('Company-Proses');
Route::put('/companies-update/{id}', [CompanyController::class,'update'])->name('CompanyEdit');
Route::delete('/companies-delete/{id}', [CompanyController::class,'delete'])->name('CompanyDelete');

Route::get('/jobs', [JobsController::class,'index'])->name('Jobs');
Route::post('/jobs-proses', [JobsController::class,'store'])->name('JobsProses');
Route::put('/jobs-update/{id}', [JobsController::class,'update'])->name('JobsEdit');
Route::delete('/jobs-delete/{id}', [JobsController::class,'destroy'])->name('JobsDelete');

Route::get('/app', [ApplicationController::class,'index'])->name('Apps');
Route::post('/app-proses', [ApplicationController::class,'store'])->name('AppsProses');
Route::put('/app-update/{id}', [ApplicationController::class,'update'])->name('AppsEdit');
Route::delete('/app-delete/{id}', [ApplicationController::class,'destroy'])->name('AppsDelete');

Route::get('/Reset-passowrd', [ResetPassword::class, 'index'])->name('ResetPassword');
    Route::post('/Update/Passowrd', [ResetPassword::class, 'UpdatePassword'])->name('UpdatePassword');

});