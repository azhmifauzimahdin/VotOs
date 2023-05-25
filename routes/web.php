<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardGantiPasswordController;
use App\Http\Controllers\DashboardKandidatController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardPemilihController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardVotingController;
use App\Http\Controllers\LoginPemilihController;
use App\Http\Controllers\UserBerandaController;
use App\Http\Controllers\UserKandidatController;
use App\Http\Controllers\UserPerolehanSuaraController;
use App\Http\Controllers\UserVotingController;

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

Route::get('/', [UserBerandaController::class, 'index'])->name('pemilih.beranda');

Route::get('/perolehan-suara', [UserPerolehanSuaraController::class, 'index'])->name('pemilih.perolehanSuara');

Route::resource('/kandidat', UserKandidatController::class)->names([
    'index' => 'pemilih.kandidat.index',
    'show' => 'pemilih.kandidat.show',
])->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::resource('/voting', UserVotingController::class)->names([
    'index' => 'pemilih.voting.index',
    'create' => 'pemilih.voting.create',
    'store' => 'pemilih.voting.store',
    'show' => 'pemilih.voting.show',
    'edit' => 'pemilih.voting.edit',
    'update' => 'pemilih.voting.update',
    'destroy' => 'pemilih.voting.destroy'
]);
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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard')->middleware('auth:web');

Route::get('/dashboard/pemilih/checkSlug', [DashboardPemilihController::class, 'checkSlug'])->middleware(['auth:web', 'pemilih']);
Route::resource('/dashboard/pemilih', DashboardPemilihController::class)->names([
    'index' => 'user.pemilih.index',
    'create' => 'user.pemilih.create',
    'store' => 'user.pemilih.store',
    'edit' => 'user.pemilih.edit',
    'update' => 'user.pemilih.update',
    'destroy' => 'user.pemilih.destroy'
])->except('show')->middleware(['auth:web', 'pemilih']);

Route::get('/dashboard/kandidat/checkSlug', [DashboardKandidatController::class, 'checkSlug'])->middleware(['auth:web', 'pemilih']);
Route::resource('/dashboard/kandidat', DashboardKandidatController::class)->names([
    'index' => 'user.kandidat.index',
    'create' => 'user.kandidat.create',
    'store' => 'user.kandidat.store',
    'show' => 'user.kandidat.show',
    'edit' => 'user.kandidat.edit',
    'update' => 'user.kandidat.update',
    'destory' => 'user.kandidat.destroy'
])->middleware(['auth:web', 'pemilih']);

Route::get('/dashboard/voting', [DashboardVotingController::class, 'index'])->name('user.voting')->middleware(['auth:web', 'pemilih']);

Route::get('/dashboard/user/checkSlug', [DashboardUserController::class, 'checkSlug'])->middleware(['auth:web', 'admin']);
Route::resource('/dashboard/user', DashboardUserController::class)->names([
    'index' => 'user.users.index',
    'create' => 'user.users.create',
    'store' => 'user.users.store',
    'edit' => 'user.users.edit',
    'update' => 'user.users.update',
    'destroy' => 'user.users.destroy',
])->except('show')->middleware(['auth:web', 'admin']);

Route::get('/dashboard/kelas/checkSlug', [DashboardKelasController::class, 'checkSlug'])->middleware(['auth:web', 'pemilih']);
Route::resource('/dashboard/kelas', DashboardKelasController::class)->names([
    'index' => 'user.kelas.index',
    'create' => 'user.kelas.create',
    'store' => 'user.kelas.store',
    'edit' => 'user.kelas.edit',
    'update' => 'user.kelas.update',
    'destroy' => 'user.kelas.destroy',
])->except('show')->middleware(['auth:web', 'pemilih']);

Route::get('/dashboard/rekapitulasi', [DashboardVotingController::class, 'rekapitulasi'])->name('user.rekapitulasi')->middleware(['auth:web', 'pemilih']);

Route::get('/dashboard/ganti_password', [DashboardGantiPasswordController::class, 'index'])->name('user.gantiPassword')->middleware('auth:web');
Route::put('/dashboard/ganti_password/{user:slug}', [DashboardGantiPasswordController::class, 'update'])->name('user.gantiPassword.update')->middleware('auth:web');

Route::get('/loginUser', [LoginUserController::class, 'index'])->name('user.login')->middleware('guest');
Route::post('/loginUser', [LoginUserController::class, 'authenticate'])->name('user.autenticate')->middleware('guest');
Route::post('/logoutUser', [LoginUserController::class, 'logout'])->name('user.logout');
