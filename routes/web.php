<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;

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
    return view('beranda', [
        "title" => "Beranda"
    ]);
});


// Route::get('/about', function () {
//     return view('about', [
//         "title" => "About",
//     ]);
// });

// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Route::get('/categories', function () {
//     return view('categories', [
//         'title' => 'Post Categories',
//         'categories' => Category::all()
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

// Votos New
Route::get('/perolehan-suara', function () {
    return view('perolehan_suara', [
        'title' => 'Perolehan Suara'
    ]);
});

Route::get('/kandidat', function () {
    return view('kandidat', [
        'title' => 'Kandidat'
    ]);
});

Route::get('/kandidat/detail', function () {
    return view('detail_kandidat', [
        'title' => 'Detail Kandidat'
    ]);
});

Route::get('/voting', function () {
    return view('voting', [
        'title' => 'Voting'
    ]);
});

Route::get('/voting/otp', function () {
    return view('otp', [
        'title' => 'One Time Password'
    ]);
});

Route::get('/voting/berhasil', function () {
    return view('voting_berhasil', [
        'title' => 'Voting Berhasil'
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
});

Route::get('/dashboard/pemilih', function () {
    return view('dashboard.pemilih.index', [
        'title' => 'Data Pemilih'
    ]);
});
Route::get('/dashboard/pemilih/create', function () {
    return view('dashboard.pemilih.create', [
        'title' => 'Tambah Data Pemilih'
    ]);
});
Route::get('/dashboard/ganti_password', function () {
    return view('dashboard.ganti_password.index', [
        'title' => 'Ganti Password'
    ]);
});
