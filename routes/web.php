<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\StudioController;

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

// Auth::routes();

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
Route::post('/admin/dashboard/update-info', [AdminController::class, 'updateInfo'])->name('admin/update/info')->middleware('AdminCheck');
Route::delete('admin/dashboard/delete-info/{info}',  [AdminController::class, 'deleteInfo'])->name('admin/delete/info')->middleware('AdminCheck');

Route::get('/admin/dashboard/create-stuff', [AdminController::class, 'showCreateStuff'])->name('admin/create/stuff')->middleware('AdminCheck');
Route::post('/admin/dashboard/create-stuff-process', [AdminController::class, 'createStuff'])->name('admin/create/stuff/process')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-stuff', [AdminController::class, 'listStuff'])->name('admin/list/stuff')->middleware('AdminCheck');
Route::post('/admin/dashboard/update-stuff', [AdminController::class, 'updateStuff'])->name('admin/update/stuff')->middleware('AdminCheck');
Route::delete('admin/dashboard/delete-stuff/{stuff}',  [AdminController::class, 'deleteStuff'])->name('admin/delete/stuff')->middleware('AdminCheck');

Route::get('/admin/dashboard/create-inventory', [AdminController::class, 'showCreateInventory'])->name('show-create-inventory')->middleware('AdminCheck');
Route::post('/admin/dashboard/create-inventory', [AdminController::class, 'createInventory'])->name('create-inventory')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-inventory', [AdminController::class, 'showListInventory'])->name('show-list-inventory')->middleware('AdminCheck');
Route::get('/admin/dashboard/detail-inventory/{id}', [AdminController::class, 'showDetailInventory'])->name('detail-inventory')->middleware('AdminCheck');
Route::delete('admin/dashboard/delete-inventory/{inventory}',  [AdminController::class, 'deleteInventory'])->name('admin/delete/inventory')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-new-account-umum', [AdminController::class, 'listNewUmum'])->name('list-new-account-umum')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-account-umum/a/{id}', [AdminController::class, 'approveUmum'])->name('umum.approve')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-account-umum/d/{id}', [AdminController::class, 'rejectUmum'])->name('umum.reject')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-new-account-anggota', [AdminController::class, 'listNewAnggota'])->name('list-new-account-anggota')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-account-anggota/a/{id}', [AdminController::class, 'approveAnggota'])->name('anggota.approve')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-account-anggota/d/{id}', [AdminController::class, 'rejectAnggota'])->name('anggota.reject')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-account-umum', [AdminController::class, 'listUmum'])->name('list-account-umum')->middleware('AdminCheck');
Route::get('/admin/dashboard/list-account-anggota', [AdminController::class, 'listAnggota'])->name('list-account-anggota')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-new-studio-booking', [AdminController::class, 'listNewStudioBooking'])->name('list-new-booking-studio')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-studio-booking/a/{id}', [AdminController::class, 'approveStudioBooking'])->name('booking.studio.approve')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-studio-booking/d/{id}', [AdminController::class, 'rejectStudioBooking'])->name('booking.studio.reject')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-studio-booking', [AdminController::class, 'listStudioBooking'])->name('list-booking-studio')->middleware('AdminCheck');
Route::get('/admin/dashboard/calendar-studio-booking', [AdminController::class, 'calendarStudioBooking'])->name('calendar-booking-studio')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-new-stuff-booking', [AdminController::class, 'listNewStuffBooking'])->name('list-new-booking-stuff')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-stuff-booking/a/{id}', [AdminController::class, 'approveStuffBooking'])->name('booking.stuff.approve')->middleware('AdminCheck');
Route::put('/admin/dashboard/list-new-stuff-booking/d/{id}', [AdminController::class, 'rejectStuffBooking'])->name('booking.stuff.reject')->middleware('AdminCheck');

Route::get('/admin/dashboard/list-stuff-booking', [AdminController::class, 'listStuffBooking'])->name('list-booking-stuff')->middleware('AdminCheck');
Route::get('/admin/dashboard/calendar-stuff-booking', [AdminController::class, 'calendarStuffBooking'])->name('calendar-booking-stuff')->middleware('AdminCheck');

Route::get('calendar', [PageController::class, 'showSewaStudio'])->name('sewa.studio.calendar');
Route::get('calendar/data', [PageController::class, 'getEvents'])->name('calendar.event');
Route::get('calendar/data/alat', [PageController::class, 'getEventsAlat'])->name('calendar.alat.event');

Route::get('www', [PageController::class, 'cekWarna'])->name('calendar.alat.warna');


// Route Register dan Login
Route::get('/register-anggota', [PenggunaController::class, 'showRegisterFormAnggota'])->name('registerAnggota');
Route::get('/register-umum', [PenggunaController::class, 'showRegisterFormUmum'])->name('registerUmum');
Route::post('/register-anggota', [PenggunaController::class, 'RegisterAnggota'])->name('post.registerAnggota');
Route::post('/register-umum', [PenggunaController::class, 'RegisterUmum'])->name('post.registerUmum');
Route::get('/login-account', [PenggunaController::class, 'showLoginForm'])->name('login');
Route::post('/login-account', [PenggunaController::class, 'Login'])->name('post.login');

// Route User
Route::group(['middleware' => ['LoginCheck']], function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('user.index');
    Route::group(['middleware' => ['AnggotaCheck']], function () {
        Route::get('/user/dashboard/inventaris', [DashboardUserController::class, 'showListInventory'])->name('user.inventaris.index');
        Route::get('/user/dashboard/inventaris/{id}', [DashboardUserController::class, 'showDetailInventory'])->name('user.inventaris.show');
    });

    Route::get('/sewa-studio', [StudioController::class, 'index'])->name('sewa.studio.index');
    Route::post('/sewa-studio', [StudioController::class, 'store'])->name('sewa.studio.store');

    Route::get('/sewa-alat', [AlatController::class, 'index'])->name('sewa.alat.index');
    Route::post('/sewa-alat', [AlatController::class, 'store'])->name('sewa.alat.store');
});

Route::group(['prefix' => 'artikels'], function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
});

Route::get('logout', function(){
    Session::flush();
    return redirect('login-account');
  })->name('user/logout');
