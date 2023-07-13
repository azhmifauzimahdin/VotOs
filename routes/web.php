<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserScanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\UserVotingController;
use App\Http\Controllers\UserBerandaController;
use App\Http\Controllers\LoginPemilihController;
use App\Http\Controllers\UserKandidatController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardScanController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardVotingController;
use App\Http\Controllers\DashboardPemilihController;
use App\Http\Controllers\DashboardKandidatController;
use App\Http\Controllers\UserPerolehanSuaraController;
use App\Http\Controllers\DashboardPelaksanaanController;
use App\Http\Controllers\DashboardGantiPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserGantiPasswordController;

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

Route::get('/loginPemilih', [LoginPemilihController::class, 'index'])->name('pemilih.login')->middleware('guest:pemilih');
Route::post('/loginPemilih', [LoginPemilihController::class, 'authenticate'])->name('pemilih.autenticate');
Route::post('/logoutPemilih', [LoginPemilihController::class, 'logout'])->name('pemilih.logout');

Route::get('/', [UserBerandaController::class, 'index'])->name('pemilih.beranda');

Route::get('/perolehan-suara', [UserPerolehanSuaraController::class, 'index'])->name('pemilih.perolehanSuara');

Route::resource('/kandidat', UserKandidatController::class)->names([
    'index' => 'pemilih.kandidat.index',
    'show' => 'pemilih.kandidat.show',
])->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::get('/voting/print', [UserVotingController::class, 'cetakPdfQrCode'])->name('pemilih.voting.cetak');
Route::controller(UserVotingController::class)->group(function () {
    Route::get('/voting', 'index')->name('pemilih.voting');
    Route::post('/voting/generate', 'generate')->name('pemilih.voting.generate');
    Route::get('/voting/otp/{slug}', 'otp')->name('pemilih.voting.otp');
    Route::post('/voting/vote', 'voteWithOtp')->name('pemilih.voting.vote');
});

Route::get('/scan', [UserScanController::class, 'index'])->name('pemilih.scan');
Route::post('/scan', [UserScanController::class, 'validasi'])->name('pemilih.scan.validasi');

Route::get('/ganti_password', [UserGantiPasswordController::class, 'index'])->name('pemilih.gantipassword')->middleware('auth:pemilih');
Route::post('/ganti_password', [UserGantiPasswordController::class, 'gantiPassword'])->name('pemilih.gantipassword.validate')->middleware('auth:pemilih');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard')->middleware('auth:web');

Route::get('/dashboard/pemilih/checkSlug', [DashboardPemilihController::class, 'checkSlug'])->middleware(['auth:web', 'panitia']);
Route::resource('/dashboard/pemilih', DashboardPemilihController::class)->names([
    'index' => 'user.pemilih.index',
    'create' => 'user.pemilih.create',
    'store' => 'user.pemilih.store',
    'edit' => 'user.pemilih.edit',
    'update' => 'user.pemilih.update',
    'destroy' => 'user.pemilih.destroy'
])->except('show')->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/kandidat/checkSlug', [DashboardKandidatController::class, 'checkSlug'])->middleware(['auth:web', 'panitia']);
Route::resource('/dashboard/kandidat', DashboardKandidatController::class)->names([
    'index' => 'user.kandidat.index',
    'create' => 'user.kandidat.create',
    'store' => 'user.kandidat.store',
    'show' => 'user.kandidat.show',
    'edit' => 'user.kandidat.edit',
    'update' => 'user.kandidat.update',
    'destory' => 'user.kandidat.destroy'
])->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/voting', [DashboardVotingController::class, 'index'])->name('user.voting')->middleware(['auth:web', 'panitia']);
Route::get('/dashboard/voting/print', [DashboardVotingController::class, 'cetakPdf'])->name('user.voting.cetakPdf')->middleware(['auth:web', 'panitia']);
Route::get('/dashboard/voting/printSuratSuara', [DashboardVotingController::class, 'cetakPdfSuratSuara'])->name('user.voting.cetakPdfSuratSuara')->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/user/checkSlug', [DashboardUserController::class, 'checkSlug'])->middleware(['auth:web', 'admin']);
Route::resource('/dashboard/user', DashboardUserController::class)->names([
    'index' => 'user.users.index',
    'create' => 'user.users.create',
    'store' => 'user.users.store',
    'edit' => 'user.users.edit',
    'update' => 'user.users.update',
    'destroy' => 'user.users.destroy',
])->except('show')->middleware(['auth:web', 'admin']);

Route::get('/dashboard/kelas/checkSlug', [DashboardKelasController::class, 'checkSlug'])->middleware(['auth:web', 'panitia']);
Route::resource('/dashboard/kelas', DashboardKelasController::class)->names([
    'index' => 'user.kelas.index',
    'create' => 'user.kelas.create',
    'store' => 'user.kelas.store',
    'edit' => 'user.kelas.edit',
    'update' => 'user.kelas.update',
    'destroy' => 'user.kelas.destroy',
])->except('show')->middleware(['auth:web', 'panitia']);

Route::post('/dashboard/pelaksanaan/selesai', [DashboardPelaksanaanController::class, 'selesai'])->name('user.pelaksanaan.selesai')->middleware(['auth:web', 'panitia']);
Route::resource('/dashboard/pelaksanaan', DashboardPelaksanaanController::class)->names([
    'index' => 'user.pelaksanaan.index',
    'create' => 'user.pelaksanaan.create',
    'store' => 'user.pelaksanaan.store',
    'edit' => 'user.pelaksanaan.edit',
    'update' => 'user.pelaksanaan.update',
    'destroy' => 'user.pelaksanaan.destroy',
])->except('show')->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/rekapitulasi', [DashboardVotingController::class, 'rekapitulasi'])->name('user.rekapitulasi')->middleware(['auth:web', 'panitia']);
Route::get('/dashboard/rekapitulasi/print', [DashboardVotingController::class, 'cetakPdfRekapitulasi'])->name('user.rekapitulasi')->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/scan', [DashboardScanController::class, 'index'])->name('user.scan')->middleware(['auth:web', 'panitia']);
Route::post('/dashboard/scan', [DashboardScanController::class, 'validasi'])->name('user.scan.validasi')->middleware(['auth:web', 'panitia']);
Route::post('/dashboard/scan/ulang', [DashboardScanController::class, 'ScanUlang'])->name('user.scan.ulang')->middleware(['auth:web', 'panitia']);

Route::get('/dashboard/ganti_password', [DashboardGantiPasswordController::class, 'index'])->name('user.gantiPassword')->middleware('auth:web');
Route::put('/dashboard/ganti_password/{user:slug}', [DashboardGantiPasswordController::class, 'update'])->name('user.gantiPassword.update')->middleware('auth:web');

Route::get('/loginUser', [LoginUserController::class, 'index'])->name('user.login')->middleware('guest');
Route::post('/loginUser', [LoginUserController::class, 'authenticate'])->name('user.autenticate')->middleware('guest');
Route::post('/logoutUser', [LoginUserController::class, 'logout'])->name('user.logout');






Route::get('/lupa-password', [ResetPasswordController::class, 'index'])->name('password.request')->middleware('guest');
Route::post('/lupa-password', [ResetPasswordController::class, 'gantiPassword'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'validasiResetPassword'])->name('password.update')->middleware('guest');
