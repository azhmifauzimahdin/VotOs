<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardKandidatController;
use App\Http\Controllers\DashboardPemilihController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LoginPemilihController;

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

// Route::get('/', function () {
//     return view('beranda', [
//         "title" => "Beranda"
//     ]);
// });


Route::get('/about', function () {
    return view('about', [
        "title" => "About",
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all()
    ]);
});

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');






// Votos New

Route::get('/loginPemilih', [LoginPemilihController::class, 'index'])->name('pemilih.login')->middleware('guest:pemilih');
Route::post('/loginPemilih', [LoginPemilihController::class, 'authenticate'])->name('pemilih.autenticate');
Route::post('/logoutPemilih', [LoginPemilihController::class, 'logout'])->name('pemilih.logout');

Route::get('/', function () {
    return view('beranda', [
        "title" => "Beranda"
    ]);
})->name('pemilih.beranda')->middleware('auth:pemilih');

Route::get('/perolehan-suara', function () {
    return view('perolehan_suara', [
        'title' => 'Perolehan Suara'
    ]);
})->name('pemilih.perolehanSuara')->middleware('auth:pemilih');

Route::get('/kandidat', function () {
    return view('kandidat', [
        'title' => 'Kandidat'
    ]);
})->name('pemilih.kandidat');

Route::get('/kandidat/detail', function () {
    return view('detail_kandidat', [
        'title' => 'Detail Kandidat'
    ]);
})->name('pemilih.detailKandidat');

Route::get('/voting', function () {
    return view('voting', [
        'title' => 'Voting'
    ]);
})->name('pemilih.voting');

Route::get('/voting/otp', function () {
    return view('otp', [
        'title' => 'One Time Password'
    ]);
})->name('pemilih.otp');

Route::get('/voting/berhasil', function () {
    return view('voting_berhasil', [
        'title' => 'Voting Berhasil'
    ]);
})->name('pemilih.berhasilVoting');


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->name('user.dashboard')->middleware('auth:web');

Route::get('/dashboard/pemilih/checkSlug', [DashboardPemilihController::class, 'checkSlug'])->middleware('auth:web');
Route::resource('/dashboard/pemilih', DashboardPemilihController::class)->names([
    'index' => 'user.pemilih.index',
    'store' => 'user.pemilih.store',
    'create' => 'user.pemilih.create',
])->middleware('auth');

Route::get('/dashboard/kandidat/checkSlug', [DashboardKandidatController::class, 'checkSlug']);
Route::resource('/dashboard/kandidat', DashboardKandidatController::class)->names([
    'index' => 'user.kandidat.index',
    'store' => 'user.kandidat.store',
    'create' => 'user.kandidat.create',
    'destory' => 'user.kandidat.destroy',
])->middleware('auth');

Route::get('/dashboard/ganti_password', function () {
    return view('dashboard.ganti_password.index', [
        'title' => 'Ganti Password'
    ]);
})->name('user.gantiPassword')->middleware('auth:web');

Route::get('/loginUser', [LoginUserController::class, 'index'])->name('user.login')->middleware('guest');
Route::post('/loginUser', [LoginUserController::class, 'authenticate'])->name('user.autenticate');
Route::post('/logoutUser', [LoginUserController::class, 'logout'])->name('user.logout');
