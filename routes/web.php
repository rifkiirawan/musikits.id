<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PenggunaController;

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

Route::get('/', [HomeController::class, 'getArtikel'])->name('getArtikel');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin-login', [AdminController::class, 'showLogin'])->name('admin/login')->middleware('LoginTrue');
Route::post('admin-login-process', [AdminController::class, 'Login'])->name('admin/login/process');
Route::get('admin-logout', function(){
    Session::flush();
    return redirect('admin-login');
  })->name('admin/logout');
Route::get('/admin/dashboard', [AdminController::class, 'showHome'])->name('admin/home')->middleware('AdminCheck');
Route::get('/admin/dashboard/register-admin', [AdminController::class, 'showRegister'])->name('admin/register')->middleware('AdminCheck');
Route::post('/admin/dashboard/register-admin-process', [AdminController::class, 'Register'])->name('admin/register/process')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-admin', [AdminController::class, 'listAdmin'])->name('admin/list')->middleware('AdminCheck');

Route::get('/admin/dashboard/create-info', [AdminController::class, 'showCreateInfo'])->name('admin/create/info')->middleware('AdminCheck');
Route::post('/admin/dashboard/create-info-process', [AdminController::class, 'createInfo'])->name('admin/create/info/process')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-info', [AdminController::class, 'listInfo'])->name('admin/list/info')->middleware('AdminCheck');

Route::get('/admin/dashboard/create-stuff', [AdminController::class, 'showCreateStuff'])->name('admin/create/stuff')->middleware('AdminCheck');
Route::post('/admin/dashboard/create-stuff-process', [AdminController::class, 'createStuff'])->name('admin/create/stuff/process')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-stuff', [AdminController::class, 'listStuff'])->name('admin/list/stuff')->middleware('AdminCheck');

Route::get('calendar', [PageController::class, 'showSewaStudio'])->name('sewa.studio.calendar');
Route::get('calendar/data', [PageController::class, 'getEvents'])->name('calendar.event');


// Route Register dan Login
Route::get('/register-anggota', [PenggunaController::class, 'showRegisterFormAnggota'])->name('registerAnggota');
Route::get('/register-umum', [PenggunaController::class, 'showRegisterFormUmum'])->name('registerUmum');
Route::get('/login-account', [PenggunaController::class, 'showLoginForm'])->name('login');


