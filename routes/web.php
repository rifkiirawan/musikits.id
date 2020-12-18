<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

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
Route::get('/admin/dashboard/artikel', [AdminController::class, 'listAdmin'])->name('admin/list')->middleware('AdminCheck');

Route::prefix('canvas-ui')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('posts', [\App\Http\Controllers\CanvasUiController::class, 'getPosts']);
        Route::get('posts/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showPost'])
             ->middleware('Canvas\Http\Middleware\Session');

        Route::get('tags', [\App\Http\Controllers\CanvasUiController::class, 'getTags']);
        Route::get('tags/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTag']);
        Route::get('tags/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTag']);

        Route::get('topics', [\App\Http\Controllers\CanvasUiController::class, 'getTopics']);
        Route::get('topics/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTopic']);
        Route::get('topics/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTopic']);

        Route::get('users/{id}', [\App\Http\Controllers\CanvasUiController::class, 'showUser']);
        Route::get('users/{id}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForUser']);
    });

    Route::get('/{view?}', [\App\Http\Controllers\CanvasUiController::class, 'index'])
         ->where('view', '(.*)')
         ->name('canvas-ui');
});
