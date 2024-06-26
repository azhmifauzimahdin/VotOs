<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserScanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\UserVotingController;
use App\Http\Controllers\UserBerandaController;
use App\Http\Controllers\LoginPemilihController;
use App\Http\Controllers\UserKandidatController;
use App\Http\Controllers\DashboardScanController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardVotingController;
use App\Http\Controllers\DashboardKandidatController;
use App\Http\Controllers\UserGantiPasswordController;
use App\Http\Controllers\UserPerolehanSuaraController;
use App\Http\Controllers\DashboardWaktuPemiluController;
use App\Http\Controllers\DashboardPemilihSiswaController;
use App\Http\Controllers\DashboardGantiPasswordController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DashboardPemilihController;
use App\Http\Controllers\DashboardPemilihGuruKaryawanController;
use App\Http\Controllers\VerifikasiLaporanController;

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

Route::controller(LoginPemilihController::class)->group(function () {
    Route::get('/loginPemilih', 'index')->name('pemilih.login')->middleware('guest:pemilih');
    Route::post('/loginPemilih', 'authenticate')->name('pemilih.autenticate')->middleware('guest:pemilih');
    Route::post('/logoutPemilih', 'logout')->name('pemilih.logout');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/lupa-password', 'index')->name('password.request')->middleware('guest:pemilih');
    Route::post('/lupa-password', 'gantiPassword')->name('password.email')->middleware('guest:pemilih');
    Route::get('/reset-password/{token}', 'resetPassword')->name('password.reset')->middleware('guest:pemilih');
    Route::post('/reset-password', 'validasiResetPassword')->name('password.update')->middleware('guest:pemilih');
});

Route::get('/', [UserBerandaController::class, 'index'])->name('pemilih.beranda');

Route::get('/perolehan-suara', [UserPerolehanSuaraController::class, 'index'])->name('pemilih.perolehanSuara');

Route::controller(UserKandidatController::class)->group(function () {
    Route::get('/kandidat', 'index')->name('pemilih.kandidat.index');
    Route::get('/kandidat/{slug}', 'detail')->name('pemilih.kandidat.detail');
});

Route::controller(UserVotingController::class)->group(function () {
    Route::get('/voting', 'index')->name('pemilih.voting');
    Route::post('/voting/generate', 'generate')->name('pemilih.voting.generate')->middleware('auth:pemilih');
    Route::get('/voting/otp', 'otp')->name('pemilih.voting.otp')->middleware('auth:pemilih');
    Route::post('/voting/vote', 'voteWithOtp')->name('pemilih.voting.vote')->middleware('auth:pemilih');
});

Route::controller(UserScanController::class)->group(function () {
    Route::get('/scan', 'index')->name('pemilih.scan');
    Route::post('/scan', 'validasi')->name('pemilih.scan.validasi');
});

Route::controller(UserGantiPasswordController::class)->group(function () {
    Route::get('/ganti_password', 'index')->name('pemilih.gantipassword')->middleware('auth:pemilih');
    Route::post('/ganti_password', 'gantiPassword')->name('pemilih.gantipassword.validate')->middleware('auth:pemilih');
});

Route::controller(VerifikasiLaporanController::class)->group(function () {
    route::get('/verifikasi/{kode}', 'index')->name('verifikasi');
});





// Dashboard
Route::controller(LoginUserController::class)->group(function () {
    Route::get('/loginUser', 'index')->name('user.login')->middleware('guest');
    Route::post('/loginUser', 'authenticate')->name('user.autenticate')->middleware('guest');
    Route::post('/logoutUser', 'logout')->name('user.logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard')->middleware('auth:web');

Route::controller(DashboardPemilihSiswaController::class)->group(function () {
    Route::get('/dashboard/pemilih/siswa/import', 'importSiswa')->name('user.pemilih.siswa.import')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/pemilih/siswa/import', 'fileImport')->name('user.pemilih.siswa.fileimport')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/pemilih/siswa/export', 'fileExport')->name('user.pemilih.siswa.import')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/pemilih/siswa/download', 'downloadTemplate')->name('user.pemilih.siswa.download')->middleware(['auth:web', 'panitia']);
});

Route::resource('/dashboard/pemilih', DashboardPemilihController::class)->names([
    'index' => 'user.pemilih.index',
    'create' => 'user.pemilih.create',
    'store' => 'user.pemilih.store',
    'edit' => 'user.pemilih.edit',
    'update' => 'user.pemilih.update',
    'destroy' => 'user.pemilih.destroy'
])->except('show')->middleware(['auth:web', 'panitia']);

Route::controller(DashboardPemilihController::class)->group(function () {
    Route::get('/dashboard/pemilih/import', 'importPemilih')->name('user.pemilih.import')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/pemilih/download', 'downloadTemplate')->name('user.pemilih.download')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/pemilih/import', 'fileImport')->name('user.pemilih.fileimport')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/pemilih/export', 'fileExport')->name('user.pemilih.import')->middleware(['auth:web', 'panitia']);
});

Route::resource('/dashboard/kandidat', DashboardKandidatController::class)->names([
    'index' => 'user.kandidat.index',
    'create' => 'user.kandidat.create',
    'store' => 'user.kandidat.store',
    'show' => 'user.kandidat.show',
    'edit' => 'user.kandidat.edit',
    'update' => 'user.kandidat.update',
    'destory' => 'user.kandidat.destroy'
])->middleware(['auth:web', 'panitia']);

Route::controller(DashboardVotingController::class)->group(function () {
    Route::get('/dashboard/voting', 'index')->name('user.voting')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/voting/print', 'cetakDataVoting')->name('user.voting.cetakDataVoting')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/voting/printSuratSuara', 'cetakPdfSuratSuara')->name('user.voting.cetakPdfSuratSuara')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/voting/ulangvoting', 'ulangVoting')->name('user.voting.ulang')->middleware(['auth:web', 'panitia']);
    Route::get('/dashboard/hasilPemilu', 'hasilPemilu')->name('user.hasilPemilu')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/hasilPemilu/print', 'cetakPdfHasilPemilu')->name('user.hasilPemilu.print')->middleware(['auth:web', 'panitia']);
});

Route::resource('/dashboard/hasilPemilu/laporan', DashboardLaporanController::class)->names([
    'index' => 'user.laporan.index',
    'create' => 'user.laporan.create',
    'store' => 'user.laporan.store',
    'edit' => 'user.laporan.edit',
    'update' => 'user.laporan.update',
    'destroy' => 'user.laporan.destroy',
])->except('show')->middleware(['auth:web', 'panitia']);

Route::resource('/dashboard/user', DashboardUserController::class)->names([
    'index' => 'user.users.index',
    'create' => 'user.users.create',
    'store' => 'user.users.store',
    'edit' => 'user.users.edit',
    'update' => 'user.users.update',
    'destroy' => 'user.users.destroy',
])->except('show')->middleware(['auth:web', 'admin']);

Route::post('/dashboard/waktupemilu/selesai', [DashboardWaktuPemiluController::class, 'selesai'])->name('user.pelaksanaan.selesai')->middleware(['auth:web', 'panitia']);
Route::resource('/dashboard/waktupemilu', DashboardWaktuPemiluController::class)->names([
    'index' => 'user.pelaksanaan.index',
    'create' => 'user.pelaksanaan.create',
    'store' => 'user.pelaksanaan.store',
    'edit' => 'user.pelaksanaan.edit',
    'update' => 'user.pelaksanaan.update'
])->parameters(['waktupemilu' => 'pemilu'])->except(['show', 'destroy'])->middleware(['auth:web', 'panitia']);

Route::controller(DashboardScanController::class)->group(function () {
    Route::get('/dashboard/scan', 'index')->name('user.scan')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/scan', 'validasi')->name('user.scan.validasi')->middleware(['auth:web', 'panitia']);
    Route::post('/dashboard/scan/ulang', 'ScanUlang')->name('user.scan.ulang')->middleware(['auth:web', 'panitia']);
});

Route::controller(DashboardGantiPasswordController::class)->group(function () {
    Route::get('/dashboard/ganti_password', 'index')->name('user.gantiPassword')->middleware('auth:web');
    Route::put('/dashboard/ganti_password/{user:slug}', 'update')->name('user.gantiPassword.update')->middleware('auth:web');
});
