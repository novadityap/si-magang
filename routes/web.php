<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;

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

Route::controller(AuthController::class)->group(function() {
  Route::get('/', 'index')->name('login');
  Route::post('/login', 'prosesLogin')->name('proses.login');
  Route::get('/logout', 'logout')->name('logout');
});

Route::controller(PasswordController::class)->middleware(['guest'])->group(function() {
  Route::get('/lupa-password', 'lupaPassword')->name('password.request');
  Route::post('/lupa-password', 'prosesLupaPassword')->name('password.email');
  Route::get('/reset-password/{token}', 'resetPassword')->name('password.reset');
  Route::post('/reset-password', 'prosesResetPassword')->name('password.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:superuser,web')->name('dashboard');

Route::controller(ProfilController::class)->middleware('auth:superuser,web')->group(function() {
  Route::get('/edit-profil/{id}', 'editProfil')->name('edit.profil');
  Route::put('/update-profil/{id}', 'updateProfil')->name('update.profil');
  Route::post('/update-password/{id}', 'updatePassword')->name('update.password');
  Route::delete('/hapus-profil/{id}', 'hapusProfil')->name('hapus.profil');
});

Route::controller(UserController::class)->middleware('auth:superuser')->group(function() {
  Route::get('/daftar-user', 'index')->name('daftar.user');
  Route::post('/tambah-user', 'tambahUser')->name('tambah.user');
  Route::post('/tambah-superuser', 'tambahSuperuser')->name('tambah.superuser');
  Route::get('/edit-user/{user}', 'editUser')->name('edit.user');
  Route::get('/edit-superuser/{superuser}', 'editSuperuser')->name('edit.superuser');
  Route::put('/update-user/{user}', 'updateUser')->name('update.user');
  Route::put('/update-superuser/{superuser}', 'updateSuperuser')->name('update.superuser');
  Route::delete('/hapus-user/{user}', 'hapusUser')->name('hapus.user');
});

Route::controller(UserController::class)->group(function() {
  Route::get('/user', 'index')->name('user');
});



